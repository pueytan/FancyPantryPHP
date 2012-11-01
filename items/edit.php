<html>
<head>
  <title>Edit Item</title>
  <?php 
  require '../head_includes.php';
  defined("TABLE_NAME") ? NULL : define("TABLE_NAME", 'items') ;
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
              "`name` = :name, " .
              "`category` = :category " .
              "WHERE `upc` = :upc";
      $data = $db->prepare($query);
      $data->bindValue(':upc', $_POST['upc']);
      $data->bindValue(':name', $_POST['name']);
      $data->bindValue(':category', $_POST['category']);
      $data->execute();
      echo "Update Sucessful";
    }catch(PDOException $e){
      echo "Error updating: " . $e->getMessage();
    }
  }

  //Populate form
  try{
    $query = "SELECT *  FROM ". TABLE_NAME . " WHERE upc = ?";
    $data = $db->prepare($query);
    $data->bindParam(1, $_REQUEST['upc']);
    $data->execute();
    $data = $data->fetch(PDO::FETCH_ASSOC);
    $data['upc'] = str_pad($data['upc'], 12, "0", STR_PAD_LEFT);
  }catch(PDOException $e){
    echo "Error retrieving: " . $e->getMessage();
  }
echo '<br />action: ' . $action . "<br />";
  ?>
  <form action="#" method="post">
    <?php require 'keyValTable.inc'; ?>
    <input type='hidden' name='action' value="update" />
    <input type="submit" value="Update" />
  </form>
</body>
</html>