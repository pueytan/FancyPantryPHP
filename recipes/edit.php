<html>
<head>
  <title>Edit Recipe</title>
  <?php 
  require '../head_includes.php';
  defined("TABLE_NAME") ? NULL : define("TABLE_NAME", 'recipes') ;
  ?>
</head>
<body>
  <?php 
  require '../body_includes.php';
  require '../db_connect.php';
  
  if ( isset( $_POST['action'] ) )
    $action = $_POST['action'];
  else
    $action = "view";
  
  if( "update" == $action ){
    try{
      $query = "UPDATE ". TABLE_NAME ." SET ".
              "`title` = :title, " .
              "`notes` = :notes " .
              "WHERE `id` = :id";
      $data = $db->prepare($query);
      $data->bindValue(':title', $_POST['title']);
      $data->bindValue(':notes', $_POST['notes']);
      $data->bindValue(':id', $_POST['id']);
      $data->execute();
      echo "Update Sucessful";
    }catch(PDOException $e){
      echo "Error updating: " . $e->getMessage();
    }
  }

  //Populate form
  try{
    $query = "SELECT *  FROM ". TABLE_NAME . " WHERE id = ?";
    $data = $db->prepare($query);
    $data->bindParam(1, $_REQUEST['id']);
    $data->execute();
    $data = $data->fetch(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo "Error retrieving: " . $e->getMessage();
  }
  ?>
  <form action="#" method="post">
    <?php require 'keyValTable.inc'; ?>
    <input type='hidden' name='action' value="update" />
    <input type="submit" value="Update" />
  </form>
</body>
</html>