<?php
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'student');

  $conn =new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($conn === false) {
      die("ERROR: Could not connect. " .mysqli_connect_error());
  }
  $conn->set_charset("utf8mb4");

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// try {
//   $mysqli = new mysqli(DB_SERVER,  DB_USERNAME, DB_PASSWORD,DB_NAME);
//   $mysqli->set_charset("utf8mb4");
// } catch(Exception $e) {
//   error_log($e->getMessage());
//   exit('Error connecting to database'); //Should be a message a typical user could understand
// }

?>