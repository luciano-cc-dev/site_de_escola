<?php
header('Content-Type: application/json');
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $interesse = $_POST['interesse'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';

    // Aqui: NÃO incluímos o campo "id", pois ele é AUTO_INCREMENT
    $sql = "INSERT INTO contatos (nome, email, telefone, interesse, mensagem)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Erro na preparação da query: ' . $conn->error
        ]);
        exit;
    }

    $stmt->bind_param("sssss", $nome, $email, $telefone, $interesse, $mensagem);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'sucesso',
            'mensagem' => 'Mensagem enviada com sucesso!'
        ]);
    } else {
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Erro ao enviar mensagem: ' . $stmt->error
        ]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Método inválido.'
    ]);
}
?>

