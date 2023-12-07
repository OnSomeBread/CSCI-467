<?php
include("styles.css");
include("pass+.php");
include("order.php");

echo "<head></head>";
echo "<body>";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["quote_id"])) {
        $quoteId = $_POST["quote_id"];

        // send quote to external system
        $userQuery = $pdo->prepare("SELECT UserID FROM CustomerData WHERE QuoteID = :quoteId");
        $userQuery->bindParam(":quoteId", $quoteId, PDO::PARAM_INT);
        $userQuery->execute();
        $userResult = $userQuery->fetch(PDO::FETCH_ASSOC);
        $userID = $userResult["UserID"];

        $lineQuery = $pdo->prepare("SELECT TotalPrice From LineItems WHERE QuoteID = :quoteId");
        $lineQuery->bindParam(":quoteId", $quoteId, PDO::PARAM_INT);
        $lineQuery->execute();
        $lineResults = $lineQuery->fetchAll(PDO::FETCH_ASSOC);
        $quoteTotal = 0.00;
        foreach ($lineResults as $lineResult){
                $quoteTotal += $lineResult['TotalPrice'];
        }

        sendPurchaseOrder($quoteId,2,$userID,$quoteTotal);
        echo "Quote Sent!";
    }
    if (isset($_POST["boat_id"])) {
		$quoteId = $_POST["boat_id"];

		$deleteDepend = $pdo->prepare("DELETE FROM LineItems WHERE QuoteID = :quoteId");
		$deleteDepend->bindParam(":quoteId", $quoteId, PDO::PARAM_INT);
		$deleteDepend->execute();
		$deleteDepend = $pdo->prepare("DELETE FROM CustomerData WHERE QuoteID = :quoteId");
		$deleteDepend->bindParam(":quoteId", $quoteId, PDO::PARAM_INT);
		$deleteDepend->execute();
		
		$deleteQuery = $pdo->prepare("DELETE FROM Quotes WHERE QuoteID = :quoteId");
        	$deleteQuery->bindParam(":quoteId", $quoteId, PDO::PARAM_INT);
             	$deleteQuery->execute();
        echo "Quote has been deleted!";
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



