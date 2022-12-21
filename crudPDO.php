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
    //$dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dsn->prepare("INSERT INTO ('firstname', 'lastname','email' ) VALUES(':firstname', ':lastname',':email')");
     $query  = $dsn->query("SELECT * FROM usuarios WHERE firstname = :firstname AND lastname = :lastname");
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
       foreach($stmt->fetchAll() as $valor) {
       echo $valor;
  }
    }catch(PDOException $e){

  echo  "Error:   $e->getMessage()  Código  $e->$getCode() ";
  http_response_code(500);

    }
    
}

} #########################################################################################################

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, firstname, lastname FROM My_users");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach($stmt->fetchAll() as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>



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