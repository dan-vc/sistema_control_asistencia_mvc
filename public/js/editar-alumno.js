/* Muestra el modal de Editar Estudiante */

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('editModal');
    const cerrarModal = document.getElementById('closeEditModal');

    
    function editAlumno(id) {
        modal.style.display = 'block';

        fetch(`../../metodos/obtener_estudiante.php?id=${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la red: ' + response.statusText);
                }
                return response.json(); 
            })
            .then(data => {
                if (data.error) {
                    console.error('Error al obtener datos:', data.error);
                } else {
                    
                    document.getElementById('editStudentId').value = data.id;
                    document.getElementById('editNombre').value = data.nombres;
                    document.getElementById('editApellido').value = data.apellidos;
                    document.getElementById('editCorreo').value = data.correo;
                }
            })
            .catch(error => console.error('Error al obtener datos:', error));
    }

    
    cerrarModal.onclick = () => {
        modal.style.display = 'none';
    };

    
    window.onclick = event => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    
    document.querySelectorAll('.boton-editar').forEach(boton => {
        boton.onclick = () => {
            const id = boton.getAttribute('data-id'); 
            editAlumno(id); 
        };
    });
});
