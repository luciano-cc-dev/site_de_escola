<?php
// Salve isso como admin/criar_usuario.php e execute no navegador só uma vez
include 'conexao.php';

$nome = 'Luciano';
$email = 'luciano@email.com';
$senha = password_hash('123456', PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senha);
$stmt->execute();
echo "Usuário criado.";

<form action="autenticar.php" method="POST">
  <h2>Login</h2>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="password" name="senha" placeholder="Senha" required><br>
  <button type="submit">Entrar</button>
</form>

?>
