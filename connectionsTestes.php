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
        $pdo = new PDO('mysql:host=localhost;dbname=nome+_DB', 'USUARIO', 'SENHA');
        $query = $pdo->prepare("SELECT * FROM utilizadores WHERE username = :username AND password = :password");
        $query->bindValue(':username', $username);
        $query->bindValue(':password', $password);

        $query->execute();

        $num = $query->rowCount();
        if ($num == 1) {
            echo "Login success!!! Welcome ".$row['username'] . ''. $row['password'];
            exit();

        } else {
            echo "Failed to login";
        }
    }

}