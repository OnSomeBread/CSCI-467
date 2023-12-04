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
         }
     }
     $query = $pdo->query("SELECT * FROM Quotes WHERE Status = 1;");
     update_table_with_buttons($query);

     if($query->rowCount() == 0){
         echo "<div style='text-align: center; font-family: Arial, sans-serif; font-size: 16px; margin-top: 20px;'>";
         echo "There is nothing here at the moment.";
         echo "</div>";
     }


echo "</body>";
?>
