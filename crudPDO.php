<?php
if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['btn-enviar'])){

if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email'])){


    

    $firstname = filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);

    try{

    //$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dsn = new PDO('mysql:host=localhost;dbname=testes_db', 'root', '');
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dsn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $dsn->prepare('INSERT INTO (firstname, lastname, email ) VALUES(:firstname, :lastname, :email)');

    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    
    }catch(PDOException $e){

  echo  "Error:   $e->getMessage()  $e->$getCode() ";
  http_response_code(500);

    }
    
}

} 



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="validation.php">
        <label>Nome</label>
        <input type="text" name="firstname"></input>
        <label>sobrenome</label>
        <input type="text" name="lastname"></input>
        <label>Email</label>
        <input type="text" name="email"></input>
        <input type="submit" name="btn-enviar" value="Enviar" />
    </form>
</body>

</html>