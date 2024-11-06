document.addEventListener('DOMContentLoaded', function () {
    const botonesAsistencia = document.querySelectorAll('.btn-asistencia');

    botonesAsistencia.forEach(button => {
        button.addEventListener('click', async function () {
            const alumnoId = this.getAttribute('data-id');
            const estado = this.getAttribute('data-value');
            const bloqueId = this.getAttribute('data-bloque-id');

            try {

                const response = await fetch('http://localhost/SistemaControlAsistencia/metodos/procesoAsistencias.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        alumno_id: alumnoId,
                        estado: estado,
                        bloque_id: bloqueId,
                    }),
                });
                const data = await response.json();
                alert(data.message); 
            } catch (error) {
                console.error('Error al registrar la asistencia:', error);
                alert('Ocurrió un error al registrar la asistencia.');
            }
        });
    });
});
