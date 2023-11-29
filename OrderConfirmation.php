<?php
include("pass+.php");
include("styles.css");

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
    }
}

$query = $pdo->query("SELECT * FROM Quotes WHERE Status = 2;");
update_table_with_buttons($query);

if($query->rowCount() == 0){
    echo "There is nothing ready for confirmation, at the moment.";
}

echo "</body>";


?>



