<?php
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: listar.php');
    exit;
}

$id   = (int) $_GET['id'];
$conn = new mysqli('localhost', 'root', '', 'escola');
if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}

$stmt = $conn->prepare('DELETE FROM contatos WHERE id = ?');
if ($stmt) {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}
$conn->close();

header('Location: listar.php?mensagem=excluido');
exit;
