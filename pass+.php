<?php
//z-id
$username = "z1927111";
//yyyyMmmdd
$password = "2002Sep16";
//z-id
$dbname   = "z1927111"; 

try {
     $dsn = "mysql:host=courses;dbname={$dbname}";
     $pdo = new PDO($dsn, $username, $password);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOexception $e) {
     echo "Connection to database failed: " . $e->getMessage();
}
?>
