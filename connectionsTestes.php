<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {

    $erros = array();
    // Obtém valores do formulário do arquivo login.php
    $name = strip_tags(htmlspecialchars($_POST['name']));
    $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_EMAIL);
    $password= filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);
    //verifica se alguma variavel é uma variável vazia
    if (empty($username) || empty($password)) {
        //$password = md5($password);
        echo $erros[] = "<li>Todos os campos são obrigatórios! </li>";
    } else {
        //conexão  Successfull and Happy path
        $pdo = new PDO('mysql:host=localhost;dbname=testes_db', 'root', '');
        $query = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND password1 = :password1");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $query->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':password1', $password, PDO::PARAM_STR);

        $query->execute();

        $num = $query->rowCount();
        if ($num == 1) { 
            echo "<li>Login success!!! Username $username e $password </li>";
            http_response_code(200);
            

            echo "Login success!!!$username and  Password $password";

        } else {
            echo $erros[] = "Failed to login";
            http_response_code(500);
        }
    }

}