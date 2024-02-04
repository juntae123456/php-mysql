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
$author ='';
$update_link ='';
$delete_link = '';
if(isset($_GET['id'])){
  $filtered_id = $conn -> real_escape_string($_GET['id']);  
  $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id={$filtered_id}";
  $result = $conn -> query($sql);
  $row = $result -> fetch_array();
  $article['title']=htmlspecialchars($row['title']);
  $article['description']=htmlspecialchars($row['description']);
  $article['name']=htmlspecialchars($row['name']);
  $update_link = '<a href="update.php?id='.$_GET['id'].'">update</a>';
  $delete_link = '
  <form action="process_delete.php" method="post">
  <input type ="hidden" name="id" value="'.$_GET['id'].'">
  <input type ="submit" VALUE="delete">
  </form>';
  $author = "<p> by {$article['name']}</p>";
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
    <p><a href = "author.php">author</a></p>
    <ol>
      <?=$list?>
    </ol>
    <a href="create.php">create</a>
    <?=$update_link?>
    <?=$delete_link?>
    <h2><?=$article['title']?></h2>
    <?=$article['description']?>
    <?=$author?>
  </body>
</html>