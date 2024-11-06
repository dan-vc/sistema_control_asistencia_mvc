document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById("modal");
    const btn = document.getElementById("openModal");
    const span = document.getElementById("closeModal");


    btn.onclick = function () {
        modal.style.display = "block";
        obtenerEstudiantes();
    }


    span.onclick = function () {
        modal.style.display = "none";
    }


    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


    const editModal = document.getElementById("editModal");
    const closeEditModal = document.getElementById("closeEditModal");


    closeEditModal.onclick = function () {
        editModal.style.display = "none";
    }


    window.onclick = function (event) {
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
    }
});


function obtenerEstudiantes() {
    modal.style.display = 'block';

    fetch(`../../metodos/obtener_estudiantes.php`)
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
                const selectEstudianteInput = document.getElementById("selectEstudianteInput");

                selectEstudianteInput.innerHTML = "";
                const option = document.createElement('option');
                option.innerHTML = `Seleccione uno existente`;
                option.value = "";
                selectEstudianteInput.append(option)

                data.forEach(element => {
                    const option = document.createElement('option');
                    option.value = element.id;

                    option.innerHTML = `${element.nombres} ${element.apellidos}`;

                    selectEstudianteInput.append(option)
                });


                selectEstudianteInput.addEventListener('change', () => {
                    if (selectEstudianteInput.value != "") {
                        fillStudentData(selectEstudianteInput.value)
                    } else {
                        resetStudentData()
                    }
                })
            }
        })
        .catch(error => console.error('Error al obtener datos:', error));
}

function fillStudentData(id) {
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
                document.getElementById('studentNombre').value = data.nombres;
                document.getElementById('studentApellido').value = data.apellidos;
                document.getElementById('studentCorreo').value = data.correo;
                document.getElementById('studentClave').value = data.clave;
            }
        })
        .catch(error => console.error('Error al obtener datos:', error));
}

function resetStudentData() {
    document.getElementById('studentNombre').value = "";
    document.getElementById('studentApellido').value = "";
    document.getElementById('studentCorreo').value = "";
    document.getElementById('studentClave').value = "";
}