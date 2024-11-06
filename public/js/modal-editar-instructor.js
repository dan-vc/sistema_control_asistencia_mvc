document.addEventListener('DOMContentLoaded', () => {
    const editModal = document.getElementById('editInstructorModal');
    const editInstructorForm = document.getElementById('editInstructorForm');

    document.getElementById('closeEditModalButton').onclick = () => {
        editModal.style.display = 'none';
    };

    window.openEditModal = (id, name, surname, email) => {
        document.getElementById('editInstructorId').value = id;
        document.getElementById('editInstructorName').value = name;
        document.getElementById('editInstructorSurname').value = surname;
        document.getElementById('editInstructorEmail').value = email;
        editModal.style.display = 'block';
    };

    editInstructorForm.addEventListener('submit', async (event) => {
        event.preventDefault();
    
        const id = document.getElementById('editInstructorId').value;
        const updatedData = {
            nombre: document.getElementById('editInstructorName').value,
            apellido: document.getElementById('editInstructorSurname').value,
            correo: document.getElementById('editInstructorEmail').value,
        };
    
        try {
            const response = await fetch(`../../metodos/anadir_instructores.php?action=editarInstructor&id=${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(updatedData),
            });
            const data = await response.json();
            if (data.success) {
                alert('Instructor actualizado con éxito');
                location.reload(); 
            } else {
                alert('Error: ' + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al actualizar el instructor: ' + error.message);
        }
    });
});
