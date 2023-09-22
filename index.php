<?php
session_start();

include 'conexao.php';

$mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do formulário
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    echo $login . "<br>";
    echo $senha;

    // Consulta SQL
    $sql = "SELECT nome_completo ,senha FROM usuario WHERE login = ?";

    // Prepare a consulta SQL com prepared statements
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincule o parâmetro e execute a consulta
        $stmt->bind_param("s", $login);
        $stmt->execute();

        // Obtenha o resultado da consulta
        $result = $stmt->get_result();

        // Verifique se o usuário foi encontrado no banco de dados
        if ($result->num_rows === 1) {
            // O usuário foi encontrado, obtenha o hash da senha
            $row = $result->fetch_assoc();
            $hashSenhaArmazenada = $row['senha'];
            $nomeCompleto = $row['nome_completo'];

            // Verifique se a senha fornecida pelo usuário corresponde ao hash armazenado
            if (password_verify($senha, $hashSenhaArmazenada)) {
                // A senha é válida, o login é bem-sucedido
                $_SESSION['autenticado'] = true;
                $_SESSION['nome_completo'] = $nomeCompleto; // Defina a variável de sessão para o nome completo
                header('Location: dashboard.php'); // Redirecione para a página de dashboard (ou outra página após o login)
                exit;
            } else {
                // Se a senha estiver incorreta, exiba uma mensagem de erro
                $mensagemErro = "Senha incorreta.";
            }
        } else {
            // Se o usuário não for encontrado, exiba uma mensagem de erro
            $mensagemErro = "Usuário não encontrado.";
        }

        // Feche o resultado da consulta
        $result->close();

        // Feche a declaração preparada
        $stmt->close();
    } else {
        // Se houver um erro na preparação da consulta, exiba uma mensagem de erro
        $mensagemErro = "Erro na preparação da consulta: " . $conn->error;
    }

    // Feche a conexão com o banco de dados
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container inicial">
        <div class="border border-black p-3">
            <h2>Sou revendedora</h2>
            <form method="post">
                <label for="login">E-mail</label>
                <br>
                <input type="text" name="login" id="login" required>
                <br>
                <label for="senha">Senha</label>
                <br>
                <input type="password" name="senha" id="senha" required>
                <br>
                <div class="error-message"><?php echo $mensagemErro; ?></div>
                <br>
                <input type="submit" name="enviar" id="enviar" value="Entrar">
            </form>

            <a class="cadastrar" href="cadastrar.php">Cadastre-se</a>
        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>