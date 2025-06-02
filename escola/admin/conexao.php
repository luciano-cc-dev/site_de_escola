
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "escola";

// Cria conexão
$conn = new mysqli($host, $user, $pass, $db);

// Verifica conexão
if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}
?>
