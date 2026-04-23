<?php
$nome = "";
$email = "";
$telefone = "";
$cpf = "";
$dataNascimento = "";
$erros = [];
$sucesso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefone = preg_replace('/\D/', '', $_POST["telefone"] ?? "");
    $cpf = preg_replace('/\D/', '', $_POST["cpf"] ?? "");
    $dataNascimento = $_POST["dataNascimento"] ?? "";

    if (!$nome) $erros[] = "Nome é obrigatório";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = "Email inválido";
    if (strlen($cpf) !== 11) $erros[] = "CPF inválido";


    if (empty($erros)) {
        $linha = "$nome,$email,$telefone,$cpf,$dataNascimento\n";
        file_put_contents("dados.txt", $linha, FILE_APPEND);
        $sucesso = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
<div class="container">
    <h1>Cadastro</h1>

    <form method="POST" id="formCadastro">
        <input id="nome" name="nome" placeholder="Nome completo" required><br><br>
        <input id="email" name="email" placeholder="Email" required><br><br>
        <input id="telefone" name="telefone" placeholder="Telefone" required><br><br>
        <input id="cpf" name="cpf" placeholder="CPF" required><br><br>
        <input type="date" id="dataNascimento" name="dataNascimento" required><br><br>

        <button type="submit">Enviar</button>

        <p id="mensagem"></p>

        <?php foreach ($erros as $erro): ?>
            <p style="color:red"><?= $erro ?></p>
        <?php endforeach; ?>

        <?php if ($sucesso): ?>
            <p style="color:green">Cadastro salvo com sucesso!</p>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($erros)): ?>
            <h2>Dados recebidos</h2>
            <p>Nome: <?= htmlspecialchars($nome) ?></p>
            <p>Email: <?= htmlspecialchars($email) ?></p>
            <p>Telefone: <?= htmlspecialchars($telefone) ?></p>
            <p>CPF: <?= htmlspecialchars($cpf) ?></p>
            <p>Data: <?= htmlspecialchars($dataNascimento) ?></p>
        <?php endif; ?>

    </form>
</div>

<script src="./js/main.js"></script>

<div class="corner-link">
    <a href="https://github.com/xNeohaha/Desen-Web-2-Backend">Visitar Repositório</a>
</div>
</body>
</html>
