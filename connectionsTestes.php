<?php

if (isset($_POST['username']) && ($_POST['password'])) {
    // Obtém valores do formulário do arquivo login.php
    $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password= filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);
    //verifica se alguma variavel é uma variável vazia
    if (empty($username) || empty($password)) {
        echo "<li>Todos os campos são obrigatórios! </li>";
    } else {
        //conexão 
        $pdo = new PDO('mysql:host=localhost;dbname=testes_db', 'root', '');
        $query = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND password1 = :password1");
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password1', $password, PDO::PARAM_STR);

        $query->execute();

        $num = $query->rowCount();
        if ($num == 1) {
            echo "Login success!!! Username $username e $password";
            exit();

        } else {
            echo "Failed to login";
        }
    }

}