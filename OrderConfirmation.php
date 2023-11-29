<?php
//Order Confirmation Department: The final group of company liaisons that manage the order, offer discounts,
//review the order, forward the finalized quotes, and calculate the final price prior to shipment.
//Use Cases = Send sectioned finalized quotes and add final discount to external processing system. Confirm data, in select cases: edit data. They can send emails.

include("pass+.php");

echo "<head>
     </head>";
echo "<body>";

     $query = $pdo->query("SELECT * FROM Quotes WHERE Status = 2;");
     create_table($query);

global $pdo;

    echo "<table border='1'>";
    echo "<tr><th>QuoteID</th><th>Date</th><th>SecretNote</th><th>Status</th><th>Action</th></tr>";

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['QuoteID'] . "</td>";
        echo "<td>" . $row['Date_'] . "</td>";
        echo "<td>" . $row['SecretNote'] . "</td>";
        echo "<td>" . $row['Status'] . "</td>";
        echo "<td><form method='post' action='update_status.php'>";
        echo "<input type='hidden' name='quote_id' value='" . $row['QuoteID'] . "'>";
        echo "<input type='submit' value='Update Status'>";
        echo "</form></td>";
        echo "</tr>";
    }

    echo "</table>";
}

echo "</body>";
?>
