<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

if(($_SERVER['REQUEST_METHOD'] == 'POST')){

$lastname = filter_input(INPUT_POST,'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
$firstname = filter_input(INPUT_POST,'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
$email =  filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL);



try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // prepare sql and bind parameters
  $stmt = $conn->prepare("INSERT INTO students (firstname, lastname, email)VALUES (:firstname, :lastname, :email)");
  $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
  $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email,PDO::PARAM_STR);

  
  $stmt->execute();

  echo "New records created successfully";

} catch(PDOException $e) {
    
  echo "Error: " . $e->getMessage();
}

//$stmt = $conn->prepare("DELETE FROM students WHERE id = 15");


$stmt->execute();




$stmt = null;
$conn = null;

}
?>