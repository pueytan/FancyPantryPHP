<html>
<head>
  <title>Add New Item</title>
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
    $action = "";
  
  if( "add" == $action ){
    try{ 
      $query = "INSERT INTO ". TABLE_NAME ." ".
              "( `upc`, `name`, `category` )" .
              "VALUES( :upc, :name, :category )";
      $data = $db->prepare($query);
      $data->bindValue(':upc', $_POST['upc']);
      $data->bindValue(':name', $_POST['name']);
      $data->bindValue(':category', $_POST['category']);     
      $data->execute();
      echo "New Record Added Sucessfully <br />";
      ?><a class='action_button' href='.'>Return to Index</a> <?php
      return;
    }catch(PDOException $e){
      echo "Error adding new record: " . $e->getMessage();
    }
  }
  ?>
  <form action="#" method="post">
    <?php require 'keyValTable.inc'; ?>
    <input type='hidden' name='action' value="add" />
    <input type="submit" value="Add" />
  </form>
</body>
</html>