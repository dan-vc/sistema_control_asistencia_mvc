document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('addBlockModal');
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');
    const addBlockForm = document.getElementById('addBlockForm');


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


    addBlockForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const blockName = document.getElementById('blockName')?.value;
        const professorId = document.getElementById('professorSelect')?.value;

        if (!blockName || !professorId) {
            alert('Por favor, completa todos los campos.');
            return;
        }

        console.log('Enviando datos:', { nombre: blockName, profesorId: professorId });

        fetch('../../metodos/crear_bloque.php?action=crearBloque', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ nombre: blockName, profesorId: professorId }),
        })
        .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la red: ' + response.statusText);
                }
                console.log(response)
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Bloque añadido con éxito');
                    location.reload();
                } else {
                    alert('Hubo un problema al añadir el bloque: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al añadir el bloque: ' + error.message);
            });
    });
});
