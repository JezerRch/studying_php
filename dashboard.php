<?php

// Inicie a sessão (se ainda não estiver iniciada)
session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['autenticado']) || ($_SESSION['autenticado'] !== true)) {
    // O usuário não está autenticado, redirecione-o de volta para a página de login
    header('Location: index.php');
    exit;
}

if (isset($_POST['logout'])) {
    // O usuário clicou no botão de logout, destrua a sessão
    session_destroy();

    // Redirecione para a página de login (ou qualquer outra página)
    header('Location: index.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1>Dashboard</h1>

    Seja bem vindo
    <?php
    // Exiba o nome completo do usuário se estiver definido na variável de sessão
    if (isset($_SESSION['nome_completo'])) {
        echo "<p>Seja bem-vindo, " . $_SESSION['nome_completo'] . "!</p>";
    }
    ?>

    <form method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>

</html>