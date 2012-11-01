<?php
$host = "localhost";
$db_name = "fpantry_test";
$user = "fpantry_php";
$pass = "c;temxHQ[c*F";

try{
    $db = new PDO("mysql:host={$host};dbname={$db_name}", $user, $pass );
}catch(PDOException $e){
    echo "DB Connection Error: " . $e->getMessage();
}
?>
