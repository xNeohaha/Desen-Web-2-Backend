<?php

$nome = "";
$email = "";
$telefone = "";
$cpf = "";
$dataNascimento = "";

$erros = [];
$mensagem = "";
$tipoMensagem = "";
$sucesso = false;

$db_url = getenv("DATABASE_URL");

if (!$db_url) {
    die("Erro: variável DATABASE_URL não encontrada.");
}

$conn = pg_connect($db_url);

if (!$conn) {
    die("Erro ao conectar no banco de dados.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefone = preg_replace("/\D/", "", $_POST["telefone"] ?? "");
    $cpf = preg_replace("/\D/", "", $_POST["cpf"] ?? "");
    $dataNascimento = $_POST["dataNascimento"] ?? "";


    if ($nome === "") {
        $erros[] = "Nome é obrigatório.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "E-mail inválido.";
    }

    if (strlen($telefone) < 10) {
        $erros[] = "Telefone inválido.";
    }

    if (strlen($cpf) !== 11) {
        $erros[] = "CPF inválido.";
    }

    if ($dataNascimento === "") {
        $erros[] = "Informe a data de nascimento.";
    }

    if (empty($erros)) {

        $query = "
            INSERT INTO usuarios (
                nome,
                email,
                telefone,
                cpf,
                datanascimento
            )
            VALUES ($1, $2, $3, $4, $5)
        ";

        $result = pg_query_params($conn, $query, [
            $nome,
            $email,
            $telefone,
            $cpf,
            $dataNascimento
        ]);

      if ($result) {

    header("Location: index.php?sucesso=1");
    exit;

} else {

    $mensagem = "Erro ao salvar no banco.";
    $tipoMensagem = "erro";

}

    } else {
        $mensagem = implode("<br>", $erros);
        $tipoMensagem = "erro";
    }
}


$queryLista = "
    SELECT
        id,
        nome,
        email,
        telefone,
        cpf,
        datanascimento
    FROM usuarios
    ORDER BY id DESC
";

$resultLista = pg_query($conn, $queryLista);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cadastro</title>

    <link rel="stylesheet" href="./css/main.css">

</head>

<body>

<div class="container">

    <h1>Cadastro de Usuário</h1>

    <form method="POST" id="formCadastro">

        <input
            id="nome"
            name="nome"
            placeholder="Nome completo"
            required
            value="<?= htmlspecialchars($nome) ?>"
        >
        <br><br>

        <input
            id="email"
            name="email"
            placeholder="Email"
            required
            value="<?= htmlspecialchars($email) ?>"
        >
        <br><br>

        <input
            id="telefone"
            name="telefone"
            placeholder="Telefone"
            required
            value="<?= htmlspecialchars($telefone) ?>"
        >
        <br><br>

        <input
            id="cpf"
            name="cpf"
            placeholder="CPF"
            required
            value="<?= htmlspecialchars($cpf) ?>"
        >
        <br><br>

        <input
            type="date"
            id="dataNascimento"
            name="dataNascimento"
            required
            value="<?= htmlspecialchars($dataNascimento) ?>"
        >
        <br><br>

        <button type="submit">Enviar</button>

    </form>

    <?php if ($mensagem !== ""): ?>
        <div class="mensagem <?= $tipoMensagem ?>">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>

    <h2>Usuários cadastrados</h2>

    <?php if ($resultLista && pg_num_rows($resultLista) > 0): ?>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Nascimento</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($usuario = pg_fetch_assoc($resultLista)): ?>

                    <tr>
                        <td><?= htmlspecialchars($usuario["id"]) ?></td>
                        <td><?= htmlspecialchars($usuario["nome"]) ?></td>
                        <td><?= htmlspecialchars($usuario["email"]) ?></td>
                        <td><?= htmlspecialchars($usuario["telefone"]) ?></td>
                        <td><?= htmlspecialchars($usuario["cpf"]) ?></td>
                        <td><?= htmlspecialchars($usuario["datanascimento"]) ?></td>
                    </tr>

                <?php endwhile; ?>

            </tbody>

        </table>

    <?php else: ?>

        <p>Nenhum usuário cadastrado.</p>

    <?php endif; ?>

</div>

<script src="./js/main.js"></script>

</body>
</html>
