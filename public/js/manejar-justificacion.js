document.addEventListener('DOMContentLoaded', function () {

  const selectJustificacionEstado = document.getElementById("selectJustificacionEstado");

  selectJustificacionEstado.addEventListener('change', e => {
    e.target.classList.remove('pendiente')
    e.target.classList.remove('aceptada')
    e.target.classList.remove('rechazada')
    e.target.classList.add(e.target.value)

    const justificacionId = e.target.getAttribute('data-id');
    const asistenciaId = e.target.getAttribute('data-asistencia-id');
    const status = e.target.value;    
    handleChange(justificacionId, asistenciaId, status)
  })
});


function handleChange(justificacionId, asistenciaId, status) {
  data = {
    justificacionId: justificacionId,
    asistenciaId: asistenciaId,
    status: status
  }
  
  fetch('../../metodos/actualizar_justificacion.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data),
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la red: ' + response.statusText);
      }
      return response.json();

    })
    .then(data => {
      if (data.success) {
        console.log('Justificación actualizada.');
      } else {
        console.log('Hubo un problema con la justificación: ' + data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      console.log('Error al actualizar: ' + error.message);
    });
}