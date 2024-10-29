document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal-editar');
    const cerrarModal = document.getElementById('cerrar-modal');

    document.querySelectorAll('.boton-editar').forEach(boton => {
        boton.onclick = () => {
            const id = boton.getAttribute('data-id');
            modal.style.display = 'block';

            fetch(`?action=obtenerEstudiante&id=${id}`) 
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error al obtener datos:', data.error);
                    } else {
                        document.getElementById('estudiante-id').value = data.id;
                        document.getElementById('nombre').value = data.nombres; 
                        document.getElementById('apellido').value = data.apellidos;
                    }
                })
                .catch(error => console.error('Error al obtener datos:', error));
        };
    });

    cerrarModal.onclick = () => modal.style.display = 'none';

    
    document.getElementById('form-editar').addEventListener('submit', function(event) {
        event.preventDefault(); 
    
        const formData = new FormData(this);
    
        fetch('../../controller/usuarioControllers.php', { 
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


