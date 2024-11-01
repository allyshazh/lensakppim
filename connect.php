<?php
$db_name = "mysql:host=localhost;dbname=lensakppim";
$username = "root";
$password = "";

try {
    // Create connection
    $connect = new PDO($db_name, $username, $password);
    
    // Set PDO to throw exceptions on errors
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
