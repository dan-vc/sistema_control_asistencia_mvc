document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal-editar');
    const cerrarModal = document.getElementById('cerrar-modal');

    document.querySelectorAll('.boton-editar').forEach(boton => {
        boton.onclick = () => {
            const id = boton.getAttribute('data-id');
            modal.style.display = 'block';

            fetch(`../../metodos/obtener_estudiante.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('estudiante-id').value = data.id;
                    document.getElementById('nombre').value = data.name;
                    document.getElementById('apellido').value = data.apellido;
                });
        };
    });

    cerrarModal.onclick = () => modal.style.display = 'none';

    document.getElementById('form-editar').onsubmit = e => {
        e.preventDefault();
        fetch('../../metodos/actualizar_estudiante.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id: document.getElementById('estudiante-id').value,
                name: document.getElementById('nombre').value,
                apellido: document.getElementById('apellido').value
            })
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Actualizado con éxito');
                    modal.style.display = 'none';
                    location.reload();
                }
            });
    };
});
