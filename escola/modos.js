const toggleButton = document.getElementById('modo-escuro');
const body = document.body;

toggleButton.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
});


