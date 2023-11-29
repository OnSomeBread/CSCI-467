<?php
include("pass+.php");

echo "<head></head>";
echo "<body>";
    global $pdo;

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
    create_table($query);


    echo "<td><button type='submit' name='quote_id' value='" . $row['QuoteID'] . "'>Update Status</button></td>";
    
    echo "</body>";

?>


