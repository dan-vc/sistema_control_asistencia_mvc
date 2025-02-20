function toggleAlumno(id) {
    fetch(`../../metodos/estadoAlumno.php?id=${id}`, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                console.error(data.message); 
            }
        })
        .catch(error => console.error('Error:', error));
}
