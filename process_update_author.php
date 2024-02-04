<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "opentutorials";

$conn = new mysqli($servername,$username,$password,$databasename);

settype($_POST['id'],'integer');
$filtered = array(
    'id'=> $conn -> real_escape_string($_POST['id']),
    'name'=>$conn -> real_escape_string($_POST['name']),
    'profile'=>$conn -> real_escape_string($_POST['profile'])
);

$sql = "UPDATE author SET name = '{$filtered['name']}', profile = '{$filtered['profile']}'
    WHERE id = {$filtered['id']}";


$result = $conn -> query($sql);

if($result === false){
    echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
    error_log($conn -> error);}
else{
    header('Location: author.php?id='.$filtered['id']);
}
?>