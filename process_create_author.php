<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "opentutorials";

$conn = new mysqli($servername,$username,$password,$databasename);

$filtered = array(
    'name'=>$conn -> real_escape_string($_POST['name']),
    'profile'=>$conn -> real_escape_string($_POST['profile'])
);

$sql = "INSERT INTO author(name,profile)
        VALUES('{$filtered['name']}', '{$filtered['profile']}')";

$result = $conn -> query($sql);

if($result === false){
    echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
    error_log($conn -> error);}
else{
    header('Location: author.php');
}
?>