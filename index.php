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
    $date= $_POST["dataNascimento"] ?? "";
    $cpf= $_POST["CPF"] ?? "";
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

        <form id="formCadastro"> <!-- Form do Cadastro -->
            <input name="nome" placeholder="Nome completo"> <!-- Campo Nome -->
            <input name="email" placeholder="Email"> <!-- Campo Email-->
            <input name="telefone" placeholder="+55 Telefone"> <!-- Campo Telefone-->
            <input name="cpf" placeholder="CPF">
            <input name="date" id="dataNascimento">
            <button type="submit">Enviar Cadastro</button> <!-- Enviar Dados para o JS.-->

            <p id="mensagem"></p> <!-- Placeholder de Mensagens-->
        </form>
    </div>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <h2>Dados recebidos pelo servidor</h2>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></p>
    <p><strong>E-mail:</strong> <?php echo htmlspecialchars($email); ?></p>
    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($telefone); ?></p>
    <p><strong>CPF:</strong> <?php echo htmlspecialchars($cpf); ?></p>
    <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($dataNascimento); ?></p>
    <?php endif; ?>

    <script src="./js/main.js"></script> <!-- Main.js-->
    <div class="corner-link">
    <a href="https://github.com/xNeohaha/Desen-Web-2-Backend">Visitar Repositório</a> <!-- Repositorio caso algo de errado. -->
</div>
</body>

</html>