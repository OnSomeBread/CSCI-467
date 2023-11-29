<?php
include("pass+.php");

echo "<head></head>";
echo "<body>";

$countQuery = $pdo->query("SELECT COUNT(*) as count FROM Quotes WHERE Status = 2");
$countResult = $countQuery->fetch(PDO::FETCH_ASSOC);
$itemCount = $countResult['count'];

if ($itemCount < 0){
    echo "Nothing here";;
}

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

echo "</body>";


?>



