<?php
include("styles.css");
include("pass+.php");

echo "<head></head>";
echo "<body>";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["quote_id"])) {
        $quoteId = $_POST["quote_id"];

        // Update the "Status" to 3 for the selected QuoteID
        $updateQuery = $pdo->prepare("UPDATE Quotes SET Status = 3 WHERE QuoteID = :quoteId");
        $updateQuery->bindParam(":quoteId", $quoteId, PDO::PARAM_INT);
        $updateQuery->execute();

        sendPurchaseOrder(1,2,3,15.50);
    }
}

$query = $pdo->query("SELECT * FROM Quotes WHERE Status = 2;");


if($query->rowCount() == 0){
    echo "<div style='text-align: center; font-family: Arial, sans-serif; font-size: 16px; margin-top: 20px;'>";
    echo "There is nothing ready for confirmation at the moment.";
    echo "</div>";
}
else {
    update_table_with_buttons($query);
}

echo "</body>";


?>



