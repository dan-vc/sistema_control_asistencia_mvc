function displayModal(title = 'Aquí va el título', msg = 'Aquí va el mensaje') {

  const modal = document.createElement('div');
  modal.id = 'modal-wrapper';
  modal.classList.add('modal');
  modal.style.display = 'block';

  const modalContenido = document.createElement('div');
  modalContenido.classList.add('modal-contenido');


  modalContenido.innerHTML = `
  <span class="cerrar" id="cerrar-modal">&times;</span>
  <h2>${title}</h2>
  <p>${msg}</p>`;

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
}
