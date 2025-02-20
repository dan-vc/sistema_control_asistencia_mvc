document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('addInstructorModal');
    const openModalButton = document.getElementById('openInstructorModalButton');
    const closeModalButton = document.getElementById('closeInstructorModalButton');
    const addInstructorForm = document.getElementById('addInstructorForm');

    openModalButton.onclick = () => {
        modal.style.display = 'block';
    };

    closeModalButton.onclick = () => {
        modal.style.display = 'none';
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    addInstructorForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const instructorName = document.getElementById('instructorName').value;
        const instructorLastName = document.getElementById('instructorSurname').value;
        const instructorEmail = document.getElementById('instructorEmail').value;
        const instructorPassword = document.getElementById('instructorPassword').value;

        fetch('../../metodos/anadir_instructores.php?action=crearInstructor', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                nombre: instructorName,
                apellido: instructorLastName,
                correo: instructorEmail,
                clave: instructorPassword,
                rol_id: 2 
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la red: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Instructor añadido');
                
                location.reload();
            } else {
                alert('Hubo un problema' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al añadir el instructor: ' + error.message);
        });
    });
});
