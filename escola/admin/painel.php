<?php
include 'conexao.php';
$sql = "SELECT * FROM contatos ORDER BY data_envio DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel Administrativo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-5">
    <h1 class="mb-4">Mensagens Recebidas</h1>
    <table class="table table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Mensagem</th>
          <th>Data</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($linha = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $linha["id"] ?></td>
          <td><?= htmlspecialchars($linha["nome"]) ?></td>
          <td><?= htmlspecialchars($linha["email"]) ?></td>
          <td><?= nl2br(htmlspecialchars($linha["mensagem"])) ?></td>
          <td><?= $linha["data_envio"] ?></td>
          <td>
            <a href="editar.php?id=<?= $linha['id'] ?>">✏️ Editar</a> |
            <a href="excluir.php?id=<?= $linha['id'] ?>" onclick="return confirm('Deseja excluir esta mensagem?')">🗑️ Excluir</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <a href="../index.html" class="btn btn-primary mt-3">Voltar ao Site</a>
  </div>
</body>
</html>
