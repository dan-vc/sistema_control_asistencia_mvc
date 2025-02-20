document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('editModal');
    const cerrarModal = document.getElementById('closeEditModal');

    
    cerrarModal.onclick = () => {
        modal.style.display = 'none';
    };

    window.onclick = event => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    
    document.getElementById('editStudentForm').addEventListener('submit', function (event) {
        event.preventDefault(); 

        const formData = new FormData(this); 

        fetch('../../metodos/actualizar_estudiante.php', {
            method: 'POST',
            body: formData 
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la red: ' + response.statusText);
            }
            return response.json(); 
        })
        .then(data => {
            if (data.success) {
                alert('Actualización exitosa');
                location.reload(); 
            } else {
                alert('Hubo un problema con la actualización: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar: ' + error.message);
        });
    });
});
