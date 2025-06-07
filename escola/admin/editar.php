<?php
// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "escola");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica e obtém o ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consulta segura com prepared statement
$stmt = $conn->prepare("SELECT * FROM contatos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Registro não encontrado.";
    exit;
}

$dado = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Contato</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h1 class="mb-4">Editar Contato</h1>

  <form action="atualizar.php" method="POST" class="row g-3">
    <input type="hidden" name="id" value="<?= $dado['id'] ?>">

    <div class="col-md-6">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control"
             value="<?= htmlspecialchars($dado['nome']) ?>" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control"
             value="<?= htmlspecialchars($dado['email']) ?>" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Telefone</label>
      <input type="text" name="telefone" class="form-control"
             value="<?= htmlspecialchars($dado['telefone']) ?>" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Área de Interesse</label>
      <select name="interesse" class="form-select" required>
        <option value="" disabled>Selecione</option>
        <?php
        $opcoes = ['Matrícula', 'Turnos', 'Mensalidade'];
        foreach ($opcoes as $op) {
            $selected = ($dado['interesse'] === $op) ? 'selected' : '';
            echo "<option value=\"$op\" $selected>$op</option>";
        }
        ?>
      </select>
    </div>

    <div class="col-12">
      <label class="form-label">Mensagem</label>
      <textarea name="mensagem" rows="5" class="form-control"
                required><?= htmlspecialchars($dado['mensagem']) ?></textarea>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-success">Atualizar</button>
      <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>

  <!-- Scripts do Bootstrap e seus complementos -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ho+j7jyWK8fNQe+A12s7bZAzc5Y9azE+7moCG27cJvZ38OqEZvF5UwAk5qV7H3gi"
          crossorigin="anonymous"></script>
</body>
</html>
