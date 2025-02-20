document.addEventListener('DOMContentLoaded', function () {
    const botonesAsistencia = document.querySelectorAll('.btn-asistencia');

    if (typeof estadosAsistencia !== 'undefined') {
        estadosAsistencia.forEach(({ alumno_id, estado }) => {
            const boton = document.querySelector(`button[data-id="${alumno_id}"][data-value="${estado}"]`);
            if (boton) boton.classList.add('btn-activo');
        });
    }

    botonesAsistencia.forEach(button => {
        button.addEventListener('click', async function () {
            const alumnoId = this.dataset.id;
            const estado = this.dataset.value;
            const bloqueId = this.dataset.bloqueId;

            try {
                const response = await fetch('../../metodos/procesoAsistencias.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ alumno_id: alumnoId, estado, bloque_id: bloqueId }),
                });
                const data = await response.json();

                if (data.success) {
                    alert(data.message);

                    document.querySelectorAll(`button[data-id="${alumnoId}"]`).forEach(btn => btn.classList.remove('btn-activo'));
                    this.classList.add('btn-activo');
                } else {
                    alert('No se pudo registrar la asistencia. Intenta nuevamente.');
                }
            } catch (error) {
                console.error('Error al registrar la asistencia:', error);
                alert('Ocurrió un error al registrar la asistencia.');
            }
        });
    });
});
