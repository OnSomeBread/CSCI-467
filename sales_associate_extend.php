<html><head><title>Sales Associate</title></head><body>
<?php	      
	
	echo "<h1>Plant Repair Services Portal</h1>";

	$username='student';  //change
	$password='student'; //change

	try{
		$dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
		$pdo = new PDO($dsn,$username,$password);

		$rs = $pdo->query("SELECT name FROM customers;");
		$rows = $rs->fetchAll(PDO::FETCH_COLUMN); //fetch customer names
		//draw_table($rows);

		echo "\n";

		echo "<form method=POST action=>";
		echo '<label for="customer">Select Customer:</label>'; 
		echo '<select id="customer" name="selected_customer">';
		echo '<option value="">select one</option>';
		foreach ($rows as $option){
			echo "<option value=\"$option\">$option</option>";			  }
		echo '<input type="submit" value="New Quote">';
		echo '</select><br/>';	
		echo "</form>";

		if ($_SERVER["REQUEST_METHOD"] == "POST"){ //check if form is submitted
			$selectedcustomer = $_POST["selected_customer"];

			$rs = $pdo->prepare("SELECT street, city, contact FROM customers WHERE name = :customer_name");
			$rs->bindParam(':customer_name', $selectedcustomer);
			$rs->execute();
			$result = $rs->fetch(PDO::FETCH_ASSOC);

			if ($result){
				echo "<h4>Quote For: $selectedcustomer</h4>";
				foreach($result as $value){
					echo " $value<br>";
				}

				echo "<br>";

				echo "<form method=POST action='quote.php'>";
				
				echo '<label for="id">Customer Id:</label>';
				echo '<input type="text" id="id" name="id">';
				echo "<br>";
				echo "<br>";

				echo '<label for="email">Email:</label>';
				echo '<input type="text" id="email" name="email">';
				echo "<br>";
				echo "<br>";

				echo '<label for="item">Line Item:</label>';
				echo '<input type="text" id="itemName" name="itemName">';
				echo '<input type="text" id="itemQuantity" name="itemQuantity">';

				echo "<br>";
				echo "<br>";
				
				echo '<label for="note">Secrete Note:</label>';
				echo '<input type="text" id="note" name="note">';

				echo '<label for="note">Discount:</label>';
				echo '<input type="text" id="discount" name="discount">';
				

				echo "<br>";
				echo "<br>";
				echo '<button type="submit" name="quote">Finalize Quote</button>';
				echo "</form>";	

					
			}else{

				echo "No New Quote";
			}

			
		}

	}
	catch(PDOexception $e){
		echo "Connection to database failed: ".$e->getMessage();
	}
	






?>

</pre></body></html>
