<?php
session_start();

include 'conexao.php';

$mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do formulário
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar se o usuário existe no banco de dados
    $sql = "SELECT * FROM usuario WHERE login = ? AND senha = ?";

    // Prepare a consulta SQL com prepared statements
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincule os parâmetros e execute a consulta
        $stmt->bind_param("ss", $login, $senha);
        $stmt->execute();

        // Obtenha o resultado da consulta
        $result = $stmt->get_result();

        // Verifique se o usuário foi encontrado no banco de dados
        if ($result->num_rows === 1) {
            // O usuário foi autenticado com sucesso
            $_SESSION['autenticado'] = true;
            header('Location: dashboard.php'); // Redirecione para a página de dashboard (ou outra página após o login)
            exit;
        } else {
            // Se o usuário não for encontrado ou a senha estiver incorreta, exiba uma mensagem de erro
            $mensagemErro = "Usuário ou senha incorretos.";
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
</head>

<body>
    <h1>Login</h1>
    <form method="post">
        <label for="login">E-mail</label>
        <br>
        <input type="text" name="login" id="login" required>
        <br>
        <label for="senha">Senha</label>
        <br>
        <input type="password" name="senha" id="senha" required>
        <br>
        <div style="color: red;"><?php echo $mensagemErro; ?></div>
        <br>
        <input type="submit" name="enviar" id="enviar" value="Entrar">
    </form>

    <a href="cadastrar.php">Cadastre-se</a>
</body>

</html>