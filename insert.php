<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "opentutorials";

$sql = "INSERT INTO topic(title, description,created)VALUES('MySQL', 'MySQL is ..', NOW())";

$conn = new mysqli($servername,$username,$password,$databasename);

$result = $conn -> query($sql);

if($result === false){
 echo $conn -> error;}

?>