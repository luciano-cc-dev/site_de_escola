document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formContato');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const dados = new FormData(form);

    try {
      const response = await fetch('./admin/enviar.contato.php', {
        method: 'POST',
        body: dados
      });

      const resultado = await response.json();

      if (resultado.status === 'sucesso') {
        form.reset();
        mostrarToast('Sucesso', resultado.mensagem, 'https://cdn-icons-png.flaticon.com/512/561/561127.png');
      } else {
        mostrarToast('Erro', resultado.mensagem, 'https://cdn-icons-png.flaticon.com/512/463/463612.png');
      }
    } catch (error) {
      mostrarToast('Erro', 'Falha na requisição.', 'https://cdn-icons-png.flaticon.com/512/463/463612.png');
    }
  });
});

function mostrarToast(titulo, mensagem, icone) {
  document.getElementById('toastTitulo').textContent = titulo;
  document.getElementById('toastMensagem').textContent = mensagem;
  document.getElementById('toastIcon').src = icone;

  const toastElement = document.getElementById('toastContato');
  const toast = new bootstrap.Toast(toastElement);
  toast.show();
}

document.addEventListener("DOMContentLoaded", function () {
  if (localStorage.getItem('formSucesso')) {
    // Personaliza o conteúdo do toast, se quiser
    document.getElementById("toastTitulo").textContent = "Sucesso!";
    document.getElementById("toastMensagem").textContent = "Sua mensagem foi enviada com sucesso.";
    document.getElementById("toastTempo").textContent = "Agora";

    const toastEl = document.getElementById('toastContato');
    const toast = new bootstrap.Toast(toastEl);
    toast.show();

    // Limpa o sinalizador para não mostrar de novo
    localStorage.removeItem('formSucesso');
  }
});
