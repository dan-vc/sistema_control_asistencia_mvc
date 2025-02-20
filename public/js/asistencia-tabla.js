document.querySelectorAll('.btn-asistencia').forEach(button => {
    button.addEventListener('click', function() {

        const row = this.closest('tr');
        row.querySelectorAll('.btn-asistencia').forEach(btn => {
            btn.classList.remove('selected-presente', 'selected-falto', 'selected-tardanza', 'selected-justificado');
        });

        const value = this.getAttribute('data-value');
        if (value === 'presente') {
            this.classList.add('selected-presente');

        } else if (value === 'falto') {
            this.classList.add('selected-falto');

        } else if (value === 'tardanza') {
            this.classList.add('selected-tardanza');

        } else if (value === 'justificado') {
            this.classList.add('selected-justificado');
        }
    });
});
