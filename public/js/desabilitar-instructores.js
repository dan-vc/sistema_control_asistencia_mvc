function toggleInstructor(id) {
    fetch(`../../metodos/estadoInstructo.php?id=${id}`, {
        method: 'POST'
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const instructorDiv = document.getElementById(`instructor-${id}`);
            const buttonDisable = document.getElementById(`button-disable-${id}`);
            const buttonEnable = document.getElementById(`button-enable-${id}`);

            if (data.habilitado) {
                buttonDisable.style.display = 'inline';
                buttonEnable.style.display = 'none';
            } else {
                buttonDisable.style.display = 'none';
                buttonEnable.style.display = 'inline';
            }
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
