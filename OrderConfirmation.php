<?php
//Order Confirmation Department: The final group of company liaisons that manage the order, offer discounts,
//review the order, forward the finalized quotes, and calculate the final price prior to shipment.
//Use Cases = Send sectioned finalized quotes and add final discount to external processing system. Confirm data, in select cases: edit data. They can send emails.

include("pass+.php");

echo "<head>
     </head>";
echo "<body>";

     echo "hello";

     $query = $pdo->query("SELECT * FROM Quotes WHERE Status = 2;");
     create_table($query);

     

echo "</body>";
?>
