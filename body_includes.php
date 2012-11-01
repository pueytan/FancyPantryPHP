
<?php
require '../nav.php';
defined("DEBUG") ? NULL : define("DEBUG", true);

?>

<script type='text/javascript'>
  function record_delete( id, name ){
    if(confirm('Really delete ' + name + '?')){
      window.location = 'delete.php?action=delete&id=' + id;
    }
  }
</script>

