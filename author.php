<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "opentutorials";

$conn = new mysqli($servername,$username,$password,$databasename);

?>    
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1><a href = "index.php">WEB</a></h1>
    <p><a href = "index.php">topic</a></p>
    <table border="1">
        <tr>
        <td>id</td><td>name</td><td>profile</td><td></td>
        <?php
        $sql="SELECT * FROM author";
        $result = $conn -> query($sql);
        while($row= $result -> fetch_array()){
            $filtered = array(
                'id'=>htmlspecialchars($row['id']),
                'name'=>htmlspecialchars($row['name']),
                'profile'=>htmlspecialchars($row['profile']));
                ?>
                <tr>
                <td><?=$filtered['id']?></td>
                <td><?=$filtered['name']?></td>
                <td><?=$filtered['profile']?></td>
                <td><a href = "author.php?id=<?=$filtered['id']?>">update</a></td>
                <td>
                  <form action= "process_delete_author.php" method="post" onsubmit="if(!confirm('sure?')){return false;}">
                    <input type="hidden" name="id" value="<?=$filtered['id']?>">
                    <input type="submit" value="delete">
            </form>
              </tr>
              <?php
            }
            ?>
          </tr>
        </table>
        <?php
        $escaped = array(
            'name'=>'',
            'profile'=>''
        );
        $label_submit = ' Create author';
        $form_action = 'process_create_author.php';
        $form_id = '';
        if(isset($_GET['id'])){
        $filtered_id = $conn -> real_escape_string($_GET['id']);
       settype( $filtered_id,'integer');
        $sql = "SELECT * FROM author WHERE id = {$filtered_id}";
        $result = $conn -> query($sql);
        $row = $result -> fetch_array();
        $escaped['name'] = htmlspecialchars($row['name']);
        $escaped['profile'] = htmlspecialchars($row['profile']);
        $label_submit = 'update author';
        $form_action= 'process_update_author.php';
        $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
        }
        ?>                
    <form action="<?=$form_action?>" method="post">
    <?=$form_id?>
      <p><input type="text" name="name" placeholder="name" value="<?=$escaped['name']?>"></p>
      <p><textarea name="profile"><?=$escaped['profile']?></textarea></p>
      <p><input type="submit" value="<?=$label_submit?>"></p>
    </form>
    </body>
</html>