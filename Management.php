<?php
//Management: The overseers of finalized quotes, which they can reject or endorse. They manage line items, deal with prices and discounts,
//and are a direct line of email communication with customers.
//Use Cases = A lot of access, primary editors of project data. They can edit and manage most aspects of order, customer, discount admin. They can send email.
include("pass+.php");

echo "<head>
     </head>";
echo "<body>";


     $query = $pdo->query("SELECT * FROM Quotes WHERE Status = 1;");
     create_table($query);


echo "</body>";
?>
