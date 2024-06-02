<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname       = "esemkasari";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

define("BASE_URL","http://localhost/project/");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function result($data){
  $arr = array();
  while($k = mysqli_fetch_assoc($data)){
    $arr[] = $k;
  }
  return $arr;
}
?>