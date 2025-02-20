document.getElementById('abrir-modal').onclick = () => {
    document.getElementById('modal-anadir').style.display = 'block';
};

document.getElementById('cerrar-modal').onclick = () => {
    document.getElementById('modal-anadir').style.display = 'none';
};

window.onclick = (event) => {
    const modal = document.getElementById('modal-anadir');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};