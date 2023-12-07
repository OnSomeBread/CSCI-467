<?php
//Management: The overseers of finalized quotes, which they can reject or endorse. They manage line items, deal with prices and discounts,
//and are a direct line of email communication with customers.
//Use Cases = A lot of access, primary editors of project data. They can edit and manage most aspects of order, customer, discount admin. They can send email.
include("styles.css");
include("pass+.php");

echo "<head>
     </head>";
echo "<body>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["quote_id"])) {
             $quoteId = $_POST["quote_id"];
     
             // Update the "Status" to 3 for the selected QuoteID
             $updateQuery = $pdo->prepare("UPDATE Quotes SET Status = 2 WHERE QuoteID = :quoteId");
             $updateQuery->bindParam(":quoteId", $quoteId, PDO::PARAM_INT);
             $updateQuery->execute();
	     echo "Quote advanced to Order Confirmation department!";
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
	if(isset($_POST["loat_id"])) {
		$quoteId = $_POST["loat_id"];
		$result = $pdo->prepare("SELECT * FROM LineItems WHERE QuoteID = :quoteId;");
		$result->bindParam(":quoteId", $quoteId, PDO::PARAM_INT);
		$result->execute();
  		create_table($result);
	}
}
if (isset($_POST['editNote'])){
		$QuoteID = $_POST['QuoteID'];
		$Message = $_POST['message'];
		$updateSecret = $pdo->prepare("UPDATE Quotes Set SecretNote = :message WHERE QuoteID = :QuoteID");
		$updateSecret->bindParam(':message', $Message);
		$updateSecret->bindParam(':QuoteID', $QuoteID, PDO::PARAM_INT);
		$updateSecret->execute();
		echo "Secret Note changed!";
}


     $query = $pdo->query("SELECT * FROM Quotes WHERE Status = 1;");
     if($query->rowCount() == 0){
         echo "<div style='text-align: center; font-family: Arial, sans-serif; font-size: 16px; margin-top: 20px;'>";
         echo "There is nothing here at the moment.";
         echo "</div>";
     }
     else {
          update_table_with_buttons($query);
     }

	echo '<form method=POST action="">';
		echo '<h3>Enter Quote ID to edit</h3>';
		echo '<input type="text" name="QuoteID">';
   
   		echo '<label for="message">Message (up to 244 characters):</label>';
       		echo '<textarea id="message" name="message" rows="4" cols="50" maxlength="244" required></textarea>';
		echo '<button id="edit" type="submit" name="editNote">Edit Quote</button>';
  	echo '</form>';

echo "</body>";
?>
