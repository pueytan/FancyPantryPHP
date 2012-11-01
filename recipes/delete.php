<html>
<head>
  <title>Delete Recipe</title>
  <?php 
  require '../head_includes.php';
  defined("TABLE_NAME") ? NULL : define("TABLE_NAME", 'recipes') ;
  ?>
</head>
<body>
  <?php 
  require '../body_includes.php';
  require '../db_connect.php';
  
  if ( isset( $_GET['action'] ) )
    $action = $_GET['action'];
  else
    $action = "";
  
  if( "delete" == $action ){
    try{ 
      $query = "DELETE FROM ". TABLE_NAME ." WHERE id = :id";
      $data = $db->prepare($query);
      $data->bindValue(':id', $_GET['id']);
      $data->execute();
      echo "Record deleted sucessfully <br />";
      ?><a class='action_button' href='.'>Return to Index</a> <?php
      return;
    }catch(PDOException $e){
      echo "Error deleting record: " . $e->getMessage();
    }
  }
  ?>
</body>
</html>