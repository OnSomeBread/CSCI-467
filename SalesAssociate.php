<style>
* {
  box-sizing: border-box;
}

.row {
  display: flex;
  margin-left:-5px;
  margin-right:-5px;
}

.column {
  flex: 50%;
  padding: 5px;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #fffff;
}

th, td {
  text-align: left;
  padding: 16px;
}
</style>


<img src="">
<?php
include("styles.css");
include("pass+.php");

echo "<head>
     </head>";
echo "<body>";
$CurrentQID = "";
if (isset($_POST['CurrentQID'])){
	$CurrentQID = $_POST['CurrentQID'];
}
//Get username from associate and make sure to error check it
$login = "";
if (!isset($_SESSION['username'])) {
	// If not logged in, check if the login form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check username and password against the database
        $query = "SELECT * FROM SalesAssociate WHERE Username='$username' AND Password='$password'";
        $result = $pdo->query($query);

        if ($result->rowCount() > 0) {
            // If credentials are valid, store the username in the session
            $_SESSION['username'] = $username;
	    $login = "correct";
        } else {
            $login = "Invalid username or password";
		echo $login;
        }
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['newQuote'])) {
    // Execute the SQL query
    	$g = $pdo->exec("INSERT INTO Quotes (Date_, SecretNote, Status) VALUES ('" . date("m/d/Y") . "', '', '0')");
	$CurrentQID = $pdo->lastInsertID();
	echo "Your new QuoteID is " . $CurrentQID;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
try {
$pdx = new PDO("mysql:host=blitz.cs.niu.edu;dbname=csci467",'student','student');

$xs = $pdx->query("SELECT name FROM customers;");
$rows = $xs->fetchAll(PDO::FETCH_COLUMN); //fetch customer names
//draw_table($rows);

echo "\n";

if (isset($_POST['newCust'])){ //check if form is submitted
	$Name = $_POST["selected_customer"];
					  
	$xs = $pdx->prepare("SELECT street, city, contact FROM customers WHERE name = :customer_name");
	$xs->bindParam(':customer_name', $Name);
	$xs->execute();
	$xresult = $xs->fetch(PDO::FETCH_ASSOC);
    	$Email = $xresult["contact"];
    	$Country = $xresult["city"];
    	$Address = $xresult["street"];
    	$QuoteID = strval($CurrentQID);

	//Name -> Name
	//City -> country
	//street -> Address
	//Contact -> Email
    // Using prepared statement with placeholders
    $n = $pdo->prepare("INSERT INTO CustomerData (Name, Email, Country, Address, QuoteID) VALUES (:Name, :Email, :Country, :Address, :QuoteID)");
    
    // Binding parameters
    $n->bindParam(':Name', $Name);
    $n->bindParam(':Email', $Email);
    $n->bindParam(':Country', $Country);
    $n->bindParam(':Address', $Address);
    $n->bindParam(':QuoteID', $QuoteID);
	
    
    // Executing the prepared statement
    $n->execute();

    echo "Customer Successfully Added!";
}
} catch(PDOexception $e){
	echo "Connection to database failed: ".$e->getMessage();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['lineItemSub'])){
		
		$ItemName = $_POST['ItemName'];
		$Quantity = $_POST['Quantity'];
		$UnitPrice = $_POST['UnitPrice'];
		$Discount = $_POST['Discount'];
		$QuoteID = strval($CurrentQID);

		if(!empty($_POST['ItemName']) && !empty($_POST['Quantity']) && !empty($_POST['UnitPrice']) && !empty($_POST['Discount'])){

			$TotalPrice = ($UnitPrice * $Quantity) * ($Discount / 100);
			$rs = $pdo->prepare("INSERT INTO LineItems (ItemName, Quantity, UnitPrice, Discount, TotalPrice, QuoteId) VALUES (:ItemName, :Quantity, :UnitPrice, :Discount, :TotalPrice, :QuoteId)");

			$rs->bindParam(':ItemName', $ItemName);
			$rs->bindParam(':Quantity', $Quantity);
			$rs->bindParam(':UnitPrice', $UnitPrice);
			$rs->bindParam(':Discount', $Discount);
			$rs->bindParam(':TotalPrice',$TotalPrice);
			$rs->bindParam(':QuoteId',$QuoteID);
			$rs->execute();
			echo "Item added to Quote!";
		}
		else if (!empty($_POST['ItemName']) && !empty($_POST['Quantity']) && !empty($_POST['UnitPrice']) && empty($_POST['Discount'])){

			$TotalPrice = $UnitPrice * $Quantity;
			$rs = $pdo->prepare("INSERT INTO LineItems (ItemName, Quantity, UnitPrice, TotalPrice, QuoteId) VALUES (:ItemName, :Quantity, :UnitPrice, :TotalPrice, :QuoteId)");

			$rs->bindParam(':ItemName', $ItemName);
			$rs->bindParam(':Quantity', $Quantity);
			$rs->bindParam(':UnitPrice', $UnitPrice);
			$rs->bindParam(':TotalPrice',$TotalPrice);
			$rs->bindParam(':QuoteId',$QuoteID);
			$rs->execute();
			echo "Item added to Quote!";
		}
		else{
			echo "<br>";
			echo "Error: Please fill in all required fields.";
		}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['secretNote'])) {
	$QuoteID = strval($CurrentQID);
	$Message = $_POST['message'];
	//set secret note on current QuoteID
	$updateSecret = $pdo->prepare("UPDATE Quotes Set Secretnote = :message WHERE QuoteID = :quoteId");
	$updateSecret->bindParam(':message', $Message);
	$updateSecret->bindParam(':quoteId', $QuoteID, PDO::PARAM_INT);
	$updateSecret->execute();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['finishQuote'])) {
    // Execute the SQL query
	$QuoteID = strval($CurrentQID);
	//advance quote status from 0->1 from Sales Associate to Management
    	$updateQuery = $pdo->prepare("UPDATE Quotes SET Status = 1 WHERE QuoteID = :quoteId");
        $updateQuery->bindParam(':quoteId', $QuoteID, PDO::PARAM_INT);
        $updateQuery->execute();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//If invalid username, re-display prompt
if($login == "" || $login == "Invalid username or password") {
	echo '<form action="" method="POST">
			<br><br>
			<h3>Please enter a username</h3>
			<input type="text" name="username">
			<h3>Please enter a password</h3>
			<input type="text" name="password">
			<br>
			<button id="login" type="submit" name="login" value="login">Login</button
		</form>';
}

//Update page with new prompt if login is correct
if($login == "correct"){
	echo '<form method=POST action="">';
		$username = $_POST['username'];
        	$password = $_POST['password'];
		echo '<input name="username" type="hidden" value=' . $username . '>';
		echo '<input name="password" type="hidden" value=' . $password . '>';
	    	echo '<input type="submit" name="newQuote" value="Create New Quote">';
	echo '</form>';
}

//Allow for the creation of a new quote

if($login == "correct" && (isset($_POST['newQuote']) || isset($_POST['CurrentQID']))){
	echo "<form method=POST action=>";
	echo '<label for="customer">Select Customer:</label>'; 
	echo '<select id="customer" name="selected_customer">';
	echo '<option value="">select one</option>';
	foreach ($rows as $option){
		echo "<option value=\"$option\">$option</option>";			  
	}
	$username = $_POST['username'];
        $password = $_POST['password'];
	echo '<input name="username" type="hidden" value=' . $username . '>';
	echo '<input name="password" type="hidden" value=' . $password . '>';
	echo '<input name="CurrentQID" type="hidden" value=' . $CurrentQID . '>';
	echo '<input name="newCust" type="submit" value="New Customer">';
	echo '</select><br/>';	
	echo "</form>";

}
if($login == "correct" && (isset($_POST['newQuote']) || isset($_POST['CurrentQID'])) && (isset($_POST['lineItemSub']) || isset($_POST['newCust']) || isset($_POST['secretNote']))){
	echo "<form method=POST action=>";
	
	echo '<label for="ItemName">Item Name:</label>';
	echo '<input type="text" id="ItemName" name="ItemName">';
	echo "<br>";
	echo "<br>";

	echo '<label for="Quantity">Quantity:</label>';
	echo '<input type="text" id="Quantity" name="Quantity">';
	echo "<br>";
	echo "<br>";

	echo '<label for="UnitPrice">Unit Price $:</label>';
	echo '<input type="text" id="UnitPrice" name="UnitPrice">';
	echo "<br>";
	echo "<br>";

	echo '<label for="Discount">Discount %:</label>';
	echo '<input type="text" id="Discount" name="Discount">';
	echo "<br>";
	echo "<br>";

	$username = $_POST['username'];
        $password = $_POST['password'];
	echo '<input name="username" type="hidden" value=' . $username . '>';
	echo '<input name="password" type="hidden" value=' . $password . '>';
	echo '<input name="CurrentQID" type="hidden" value=' . $CurrentQID . '>';

	echo '<button type="submit" name="lineItemSub">Insert New Item</button>';

	echo "</form>";

	//NEXT FORM
	echo '<form method=POST action="">';
        	echo '<label for="message">Message (up to 244 characters):</label>';
       		echo '<textarea id="message" name="message" rows="4" cols="50" maxlength="244" required></textarea>';
	
		$username = $_POST['username'];
        	$password = $_POST['password'];
		echo '<input name="username" type="hidden" value=' . $username . '>';
		echo '<input name="password" type="hidden" value=' . $password . '>';
		echo '<input name="CurrentQID" type="hidden" value=' . $CurrentQID . '>';
        	echo '<input type="submit" name="secretNote" value="Submit secret note">';
    	echo '</form>';

//Finish the form
	echo '<form method=POST action="">';
		$username = $_POST['username'];
        	$password = $_POST['password'];
		echo '<input name="username" type="hidden" value=' . $username . '>';
		echo '<input name="password" type="hidden" value=' . $password . '>';
		echo '<input name="CurrentQID" type="hidden" value=' . $CurrentQID . '>';
	    	echo '<input type="submit" name="finishQuote" value="Finish Quote">';
	echo '</form>';
}
?>
