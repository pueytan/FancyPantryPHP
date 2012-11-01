<html>
<head>
  <title>Add New Recipe</title>
  <?php 
  require_once '../head_includes.php';
  defined("TABLE_NAME") ? NULL : define("TABLE_NAME", 'recipes') ;
  ?>
</head>
<body>
  <?php 
  require_once '../body_includes.php';
  require_once '../db_connect.php';
  
  if ( isset( $_POST['action'] ) )
    $action = $_POST['action'];
  else
    $action = "";
  
  if( "add" == $action ){
    try{ 
      $query = "INSERT INTO ". TABLE_NAME ." ".
              "( `title`, `notes` )" .
              "VALUES( :title, :notes )";
      $data = $db->prepare($query);
      $data->bindValue(':title', $_POST['title']);
      $data->bindValue(':notes', $_POST['notes']);
      $data->execute();
      
      
      //TODO: make both a transaction
      
      //TODO: Insert associated items into join table 
      if( !empty($_POST['items']) ){
        foreach($_POST['items'] as $item_upc)
        $query = "INSERT INTO ". 'items_recipes' ." ".
                "( `recipe_id`, `item_upc`, `item_qty` )" .
                "VALUES( :title, :notes )";
        $data = $db->prepare($query);
        $data->bindValue(':recipe_id', $_POST['recipe_id']);
        $data->bindValue(':item_upc', $item_upc);
        $data->execute();
      }
      echo "New Record Added Sucessfully <br />";
      ?><a class='action_button' href='.'>Return to Index</a> <?php
      return;
    }catch(PDOException $e){
      echo "Error adding new record: " . $e->getMessage();
    }
  }
  $data['id'] = 'Automatically Assigned';
  ?>
  <form action="#" method="post">
    <?php 
    require 'keyValTable.inc';
    //Fetch and populate items to be assigned to this recipe
    require_once '../db_connect.php';

    $query = "SELECT * FROM items";

    $data = $db->prepare( $query );
    $data->execute();
    while ($row = $data->fetch(PDO::FETCH_ASSOC)){
        echo '<input name="items[]" type="checkbox" value="';
        extract($row);	//unwrap all row attrs to $vars. eg. item.name = $name
        echo $upc;
        ?>" /><?php
        echo "{$name}<br />\n";
      }
    ?>
    <input type='hidden' name='action' value="add" />
    <input type="submit" value="Add" />
  </form>
</body>
</html>