<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "opentutorials";

$conn = new mysqli($servername,$username,$password,$databasename);

$filtered = array(
    'id'=> $conn -> real_escape_string($_POST['id']));

$sql = "DELETE FROM topic WHERE id = {$filtered['id']}";

$result = $conn -> query($sql);

if($result === false){
    echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
    error_log($conn -> error);}
else{
    echo '삭제에 성공했습니다. <a href="index.php">돌아가기</a>';
}
?>