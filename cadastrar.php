<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <div class="container mt-5">
        <h1>Cadastrar</h1>
        <form action="cadastrarenv.php" method="post">
            <div class="form-group">
                <label for="nome_completo">Nome Completo:</label>
                <input type="text" class="form-control" name="nome_completo" id="nome_completo" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="tel" class="form-control" name="celular" id="celular" required>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" name="cpf" id="cpf" required>
            </div>
            <div class="form-group">
                <label for="genero">Gênero:</label>
                <input type="text" class="form-control" name="genero" id="genero" required>
            </div>
            <div class="form-group">
                <label for="uf">UF:</label>
                <input type="text" class="form-control" name="uf" id="uf" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" class="form-control" name="estado" id="estado" required>
            </div>
            <div class="form-group">
                <label for="rua">Rua:</label>
                <input type="text" class="form-control" name="rua" id="rua" required>
            </div>
            <div class="form-group">
                <label for="numero_rua">Número da Rua:</label>
                <input type="text" class="form-control" name="numero_rua" id="numero_rua" required>
            </div>
            <!-- Image upload field (uncomment if needed) -->
            <!-- <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input type="file" class="form-control-file" name="imagem" id="imagem">
        </div> -->
            <div class="form-group">
                <label for="login">Login:</label>
                <input type="text" class="form-control" name="login" id="login" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" name="senha" id="senha" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Criar Usuário">
            </div>
        </form>
        <a href="index.php">Página Inicial</a>
    </div>

    <!-- Aqui é onde a mensagem de erro será exibida -->
    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>{$_GET['error']}</p>";
    }
    ?>
</body>

</html>