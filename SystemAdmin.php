<?php

include("pass+.php");

echo "<head>
     </head>";
echo "<body>";
try {
     $dsn = "mysql:host=courses;dbname={$dbname}";
     $pdo = new PDO($dsn, $username, $password);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOexception $e) {
     echo "Connection to database failed: " . $e->getMessage();
}
echo "</body>";
?>
