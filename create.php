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
$sql = "SELECT * FROM author";
$result = $conn -> query($sql);
$select_form = '<select name = "author_id">';
while($row = $result -> fetch_array()){
$select_form .= '<option value="'.$row['id'].'">'. $row['name'].'</option>';
}
$select_form .= '</select>';
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
    <form action="process_create.php" method="POST">
        <p><input type"text" name="title" placeholder="title"></P>
        <p><textarea name="description"
        placeholder = "description"></textarea></p>
        <?= $select_form?>
        <p><input type="submit"></p>
    </form>
  </body>
</html>