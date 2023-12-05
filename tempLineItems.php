<?php
	echo "<form method=POST action=>";
	
	//echo '<label for="LineId">Line Id:</label>';
	//echo '<input type="text" id="LineId" name="LineId">';
	//echo "<br>";
	//echo "<br>";

	echo '<label for="ItemName">Item Name:</label>';
	echo '<input type="text" id="ItemName" name="ItemName">';
	echo "<br>";
	echo "<br>";

	echo '<label for="Quantity">Quantity:</label>';
	echo '<input type="text" id="Quantity" name="Quantity">';
	echo "<br>";
	echo "<br>";

	echo '<label for="UnitPrice">Price $:</label>';
	echo '<input type="text" id="UnitPrice" name="UnitPrice">';
	echo "<br>";
	echo "<br>";

	echo '<label for="Discount">Discount %:</label>';
	echo '<input type="text" id="Discount" name="Discount">';
	echo "<br>";
	echo "<br>";

	echo '<label for="TotalPrice">Total Price:</label>';
	echo '<input type="text" id="TotalPrice" name="TotalPrice">';
	echo "<br>";
	echo "<br>";

	echo '<label for="QuoteId">Quote Id:</label>';
	echo '<input type="text" id="QuoteId" name="QuoteId">';
	echo "<br>";
	echo "<br>";

	echo '<button type="submit" name="submit">submit</button>';

	echo "</form>";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$ItemName = $_POST['ItemName'];
		$Quantity = $_POST['Quantity'];
		$UnitPrice = $_POST['UnitPrice'];
		$Discount = $_POST['Discount'];
		$TotalPrice = $_POST['TotalPrice'];
		$QuoteId = $_POST['QuoteId'];

		if(!empty($_POST['ItemName']) && !empty($_POST['Quantity']) && !empty($_POST['UnitPrice']) && !empty($_POST['Discount']) && !empty($_POST['TotalPrice']) && !empty($_POST['QuoteId'])){

			$pdo = new PDO("mysql:host=courses;dbname=z1927111", "z1927111", "2002Sep16");
			$rs = $pdo->prepare("INSERT INTO LineItems (ItemName, Quantity, UnitPrice, Discount, TotalPrice, QuoteId) VALUES (:ItemName, :Quantity, :UnitPrice, :Discount, :TotalPrice, :QuoteId)");

			$rs->bindParam(':ItemName', $ItemName);
			$rs->bindParam(':Quantity', $Quantity);
			$rs->bindParam(':UnitPrice', $UnitPrice);
			$rs->bindParam(':Discount', $Discount);
			$rs->bindParam(':TotalPrice',$TotalPrice);
			$rs->bindParam(':QuoteId',$QuoteId);
			$rs->execute();
		}
		else if (!empty($_POST['ItemName']) && !empty($_POST['Quantity']) && !empty($_POST['UnitPrice']) && !empty($_POST['TotalPrice']) && !empty($_POST['QuoteId']) && empty($_POST['Discount'])){
			
			$pdo = new PDO("mysql:host=courses;dbname=z1927111", "z1927111", "2002Sep16");
			$rs = $pdo->prepare("INSERT INTO LineItems (ItemName, Quantity, UnitPrice, TotalPrice, QuoteId) VALUES (:ItemName, :Quantity, :UnitPrice, :TotalPrice, :QuoteId)");

			$rs->bindParam(':ItemName', $ItemName);
			$rs->bindParam(':Quantity', $Quantity);
			$rs->bindParam(':UnitPrice', $UnitPrice);
			$rs->bindParam(':TotalPrice',$TotalPrice);
			$rs->bindParam(':QuoteId',$QuoteId);
			$rs->execute();

		}		
		else{
			echo "<br>";
			echo "Erro: Please fill in all required fields.";
		}
	}

?>





	

