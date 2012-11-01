<html>
<head>
  <title>Recipe Index</title>
  <?php 
  require '../head_includes.php';
  defined("TABLE_NAME") ? NULL : define("TABLE_NAME", 'recipes') ;
  ?>
</head>
<body>
  <?php 
  require '../body_includes.php';
  ?>
  <div>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Notes</th>
      <th>UPC</th>
    </tr>
    <?php
      require '../db_connect.php';

      $query = "SELECT * FROM ". TABLE_NAME;      //SQL Query '.' concats 2 strings

      $data = $db->prepare( $query );
      $data->execute();
      while ($row = $data->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";    //New Row
        extract($row);	//unwrap all row attrs to $vars. eg. item.name = $name
        $upc = str_pad($upc, 12, "0", STR_PAD_LEFT);
        echo "<td>"."{$id}"."</td>";
        echo "<td>"."{$title}"."</td>";
        echo "<td>"."{$notes}"."</td>";
        echo "<td>";
        echo "<a class='action_button' href='edit.php?id={$id}'>Edit</a> ";
        echo "<a class='action_button' href='#' onclick='record_delete({$id}, \"{$title}\")'>Delete</a>";
        echo "</td>";
        echo "</tr>";	//Close new row tag
      }
  ?>
  </table>
  </div>
  <div>
    <br />
    <a class='action_button' href='add.php'>Add New</a>
  </div>
</body>
</html>