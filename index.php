<?php
$nome = "";
$email = "";
$telefone = "";
$cpf = "";
$dataNascimento = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefone = $_POST["telefone"] ?? "";
    $dataNascimento = $_POST["dataNascimento"] ?? "";
    $cpf= $_POST["cpf"] ?? "";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<link rel="stylesheet" href="./css/main.css"> <!-- CSS -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title> 

</head>

<body>
    <div class="container">
        <h1>Cadastro</h1>

    <form method="POST" id="formCadastro"> <!-- Form do Cadastro -->
          <input id="nome" name="nome" placeholder="Nome completo" required><br><br>
          <input id="email" name="email" placeholder="Email" required><br><br>
          <input id="telefone" name="telefone" placeholder="Telefone" required><br><br>
          <input id="cpf" name="cpf" placeholder="CPF" required><br><br>
          <input type="date" name="dataNascimento" required><br><br>
          <button type="submit">Enviar</button>

          <p id="mensagem"></p> <!-- Placeholder de Mensagens-->

              <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                  <h2>Dados recebidos</h2>
                  <p>Nome: <?= htmlspecialchars($nome) ?></p>
                  <p>Email: <?= htmlspecialchars($email) ?></p>
                  <p>Telefone: <?= htmlspecialchars($telefone) ?></p>
                  <p>CPF: <?= htmlspecialchars($cpf) ?></p>
                  <p>Data: <?= htmlspecialchars($dataNascimento) ?></p>
              <?php endif; ?>
          
        </form>
    </div>

  

    <script src="./js/main.js"></script> <!-- Main.js-->
    <div class="corner-link">
    <a href="https://github.com/xNeohaha/Desen-Web-2-Backend">Visitar Repositório</a> <!-- Repositorio caso algo de errado. -->
</div>
</body>

</html>