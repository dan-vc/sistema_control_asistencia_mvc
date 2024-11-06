function justificarModal(id) {

    const modal = document.createElement('div');
    modal.id = 'modal-wrapper';
    modal.classList.add('modal');
    modal.style.display = 'block';

    const modalContenido = document.createElement('div');
    modalContenido.classList.add('modal-contenido');


    modalContenido.innerHTML = `
    <span class="cerrar" id="cerrar-modal">&times;</span>
    <h2>Justificar Falta</h2>
    <form id="modal-form" action="guardarJustificacion.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="${id}" required></input>
        <label for="justificacion">Razón:</label>
        <textarea name="justificacion" id="justificacion" rows="5" required></textarea>
        <label for="img">Archivo</label>
        <input type="file" name="imagen" id="imagen">
        <button type="submit" class="btn btn-green">Presentar Justificación</button>
    </form>`;

    modal.appendChild(modalContenido);
    document.body.appendChild(modal);

    document.getElementById('cerrar-modal').onclick = () => {
        document.getElementById('modal-wrapper').remove();
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            document.getElementById('modal-wrapper').remove();
        }
    };

    /* document.getElementById('modal-form').onsubmit = event => {
        event.preventDefault();

        const data = {
            id: id,
            justificacion: document.getElementById('justificacion').value,
        };
        
        console.log({ data: data });
        fetch('../../api/guardarJustificacion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: { data: data }
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                location.reload;
            })
            .catch(error => console.error('Error:', error));


        document.getElementById('modal-wrapper').remove();
    } */
}


