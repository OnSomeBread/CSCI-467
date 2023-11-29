<?php
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
    }
}

$query = $pdo->query("SELECT * FROM Quotes WHERE Status = 2;");
create_table_with_buttons($query);

echo "</body>";

function create_table_with_buttons($query)
{
    global $pdo;

   echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";

   echo '<table>';
    	while($row = $query->fetch(PDO::FETCH_ASSOC)){
		echo "<tr>";
	        	foreach($row as $col){
	                    echo '<td style="padding: 10px; border: 1px solid #ddd;">';
	                    	echo $col;
	                    echo '</td>';
	                }
	        echo "</tr>";
		echo "<td><button type='submit' name='quote_id' value='" . $row['QuoteID'] . "'>Update Status</button></td>";
	}
    echo '</table>';
    
    echo "</form>";
}
?>



