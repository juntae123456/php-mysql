<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "opentutorials";

$conn = new mysqli($servername,$username,$password,$databasename);

$sql = "SELECT * FROM topic";

$result = $conn -> query($sql);

while($row = $result -> fetch_array()){
echo '<h2>'.$row['title'].'</h2>';
echo $row['description'];
}
?>
