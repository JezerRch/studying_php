<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do formulário e valide-os (você pode adicionar mais validações aqui)
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Hash da senha
    // $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

    // Verifique se o email já existe no banco de dados
    $sql = "SELECT * FROM usuario WHERE login = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincule o parâmetro e execute a consulta
        $stmt->bind_param("s", $login);
        $stmt->execute();

        // Obtenha o resultado da consulta
        $result = $stmt->get_result();

        // Verifique se o email já está em uso
        if ($result->num_rows > 0) {
            // O email já existe, exiba uma mensagem de erro
            header('Location: cadastrar.php?error=O email já está em uso. Por favor, escolha outro email.');
        } else {
            // O email não existe, continue com o processo de criação do usuário

            // Consulta SQL para inserir o novo usuário na tabela de usuários
            $sql = "INSERT INTO usuario (login, senha) VALUES (?, ?)";

            // Prepare a consulta SQL com prepared statements
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                // Vincule os parâmetros e execute a consulta
                $stmt->bind_param("ss", $login, $senha);
                if ($stmt->execute()) {
                    // O usuário foi cadastrado com sucesso
                    echo "Usuário cadastrado com sucesso!";
                    header('Location: index.php');
                } else {
                    // Se houver um erro na consulta SQL, exiba uma mensagem de erro
                    echo "Erro ao cadastrar usuário: " . $stmt->error;
                }

                // Feche a declaração preparada
                $stmt->close();
            } else {
                // Se houver um erro na preparação da consulta, exiba uma mensagem de erro
                echo "Erro na preparação da consulta: " . $conn->error;
            }
        }

        // Feche o resultado da consulta
        $result->close();
    } else {
        // Se houver um erro na preparação da consulta, exiba uma mensagem de erro
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    // Feche a conexão com o banco de dados
    $conn->close();
} else {
    // Se o formulário não foi enviado via POST, redirecione-o de volta para a página de cadastro
    header('Location: cadastrar.php');
}
