<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
</head>

<body>
    <h1>Cadastrar</h1>
    <form action="cadastrarenv.php" method="post">
        <label for="login">Login:</label>
        <br>
        <input type="text" name="login" id="login" required>
        <br>
        <label for="senha">Senha:</label>
        <br>
        <input type="password" name="senha" id="senha" required>
        <br>
        <br>
        <input type="submit" value="Criar Usuário">
        <br>
        <br>
        <a href="index.php">Página Inicial</a>
    </form>

    <!-- Aqui é onde a mensagem de erro será exibida -->
    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>{$_GET['error']}</p>";
    }
    ?>
</body>

</html>