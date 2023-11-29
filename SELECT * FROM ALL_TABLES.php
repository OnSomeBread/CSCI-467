<?php
  include("pass+.php");

  echo "LINE ITEMS";
  $result = $pdo->query("SELECT * FROM LineItems;");
  create_table($result);
  echo "QUOTES";
  $result = $pdo->query("SELECT * FROM Quotes;");
  create_table($result);
  echo "SALESASSOCIATE";
  $result = $pdo->query("SELECT * FROM SalesAssociate;");
  create_table($result);
  echo "CUSTOMERDATA";
  $result = $pdo->query("SELECT * FROM CustomerData;");
  create_table($result);
?>
