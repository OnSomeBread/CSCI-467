<?php
//Management: The overseers of finalized quotes, which they can reject or endorse. They manage line items, deal with prices and discounts,
//and are a direct line of email communication with customers.
//Use Cases = A lot of access, primary editors of project data. They can edit and manage most aspects of order, customer, discount admin. They can send email.
include("pass+.php");

echo "<head>
     </head>";
echo "<body>";


     $query = $pdo->query("SELECT * FROM Quotes WHERE Status = 1;");

     echo '<table>';
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
	                 echo '<tr>';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $row['QuoteID'] . '</td>';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $row['Date_'] . '</td>';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $row['SecretNote'] . '</td>';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $row['Status'] . '</td>';

    echo '</tr>';
	        }
	echo '</table>';


echo "</body>";
?>
