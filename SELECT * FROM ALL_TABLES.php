<?php
  include("pass+.php");

  echo "LINE ITEMS";
  $query = "SELECT * FROM LineItems;";
  create_table($query);
  echo "QUOTES";
  $query = "SELECT * FROM Quotes;";
  create_table($query);
  echo "SALESASSOCIATE";
  $query = "SELECT * FROM SalesAssociate;";
  create_table($query);
  echo "CUSTOMERDATA";
  $query = "SELECT * FROM CustomerData;";
  create_table($query);
?>
