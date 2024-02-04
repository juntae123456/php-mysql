<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "opentutorials";

$conn = new mysqli($servername,$username,$password,$databasename);
$sql = "SELECT * FROM topic";
$result = $conn -> query($sql);
$list ='';
while($row = $result -> fetch_array()){
    //<a href = "index.php?id=19"></a>
    $escaped_title = htmlspecialchars($row['title']);
    $list = $list."<li><a href = \"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
    }
$article = array(
        'title'=>'WELCOME',
        'description'=>'HELLO, WEB'
    );
$update_link ='';
if(isset($_GET['id'])){
  $filtered_id = $conn -> real_escape_string($_GET['id']);  
  $sql = "SELECT * FROM topic WHERE id={$filtered_id}";
  $result = $conn -> query($sql);
  $row = $result -> fetch_array();
  $article['title']=htmlspecialchars($row['title']);
  $article['description']=htmlspecialchars($row['description']);
  $update_link = '<a href="update.php?id='.$_GET['id'].'">update</a>';
}

?>    
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1><a href = "index.php">WEB</a></h1>
    <ol>
      <?=$list?>
    </ol>
    <form action="process_update.php" method="POST">
      <input type="hidden" name="id" value="<?=$_GET['id']?>">
      <p><input type"text" name="title" placeholder="title" VALUE="<?=$article['title']?>"></P>
      <p><textarea name="description"
      placeholder = "description"><?=$article['description']?></textarea></p>
      <p><input type="submit"></p>
    </form>
  </body>
</html>