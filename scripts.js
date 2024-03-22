function openModal() {
    document.getElementById('contato-modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('contato-modal').style.display = 'none';
}

function salvarContato() {
    closeModal();
}

document.getElementById('add-contato-btn').addEventListener('click', openModal);

document.getElementById('contato-form').addEventListener('submit', function(e) {
    e.preventDefault();
    salvarContato();
});

document.getElementsByClassName('close')[0].addEventListener('click', closeModal);