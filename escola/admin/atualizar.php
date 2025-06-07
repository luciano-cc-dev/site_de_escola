<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'escola');
    if ($conn->connect_error) {
        die('Erro na conexão: ' . $conn->connect_error);
    }

    // Sanitização básica   
    $id        = intval($_POST['id']);
    $nome      = trim($_POST['nome']);
    $email     = trim($_POST['email']);
    $telefone  = trim($_POST['telefone']);
    $interesse = trim($_POST['interesse']);
    $mensagem  = trim($_POST['mensagem']);

    $sql  = 'UPDATE contatos
            SET nome = ?, email = ?, telefone = ?, interesse = ?, mensagem = ?
            WHERE id = ?';
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // seis strings + um inteiro
        $stmt->bind_param('sssssi', $nome, $email, $telefone, $interesse, $mensagem, $id);
        if ($stmt->execute()) {
            header('Location: listar.php?mensagem=atualizado');
            exit;
        }
        echo 'Erro ao atualizar: ' . $stmt->error;
        $stmt->close();
    } else {
        echo 'Erro ao preparar a query: ' . $conn->error;
    }
    $conn->close();
}
?>
