<?php
//Order Confirmation Department: The final group of company liaisons that manage the order, offer discounts,
//review the order, forward the finalized quotes, and calculate the final price prior to shipment.
//Use Cases = Send sectioned finalized quotes and add final discount to external processing system. Confirm data, in select cases: edit data. They can send emails.

<?php
include("pass+.php");

echo "<head></head>";
echo "<body>";

echo "hello";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["quote_id"])) {
        $quoteId = $_POST["quote_id"];

        // Update the "Status" to 3 for the selected QuoteID
        $updateQuery = $pdo->prepare("UPDATE Quotes SET Status = 3 WHERE QuoteID = :quoteId");
        $updateQuery->bindParam(":quoteId", $quoteId, PDO::PARAM_INT);
        $updateQuery->execute();
    }
}

$query = $pdo->query("SELECT * FROM Quotes WHERE Status = 2;");
create_table_with_buttons($query);

echo "</body>";

function create_table_with_buttons($query)
{
    global $pdo;

    echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
    echo "<table border='1'>";
    echo "<tr><th>QuoteID</th><th>Date</th><th>SecretNote</th><th>Status</th><th>Action</th></tr>";

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['QuoteID'] . "</td>";
        echo "<td>" . $row['Date_'] . "</td>";
        echo "<td>" . $row['SecretNote'] . "</td>";
        echo "<td>" . $row['Status'] . "</td>";
        echo "<td><button type='submit' name='quote_id' value='" . $row['QuoteID'] . "'>Update Status</button></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</form>";
}
?>

