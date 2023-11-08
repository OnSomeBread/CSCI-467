<?php

echo "<head>"
      "</head>";
echo "<body>";
try {
  
} catch(PDOexception $e) {
  echo "Connection to database failed: " . $e->getMessage();
}
echo "</body>";
?>
