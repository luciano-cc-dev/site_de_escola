<?php
session_start();           // precisamos da sessão

// Verifica se veio por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valores que você pediu
    $nomeCorreto   = 'Luciano';
    $emailCorreto  = 'lu@gmail.com';
    $senhaCorreta  = '123';

    // Dados enviados pelo formulário
    $nome  = $_POST['nome']  ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($nome === $nomeCorreto && $email === $emailCorreto && $senha === $senhaCorreta) {
        // guarda na sessão e redireciona
        $_SESSION['usuario'] = $nomeCorreto;
        header('Location: painel.php');
        exit;
    }

    // caso contrário
    header('Location: ../index2.html?erro=1');
    exit;
}
echo 'Acesso inválido.';
