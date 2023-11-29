<html><head><title>Quote</title>
</head>
<body>
<?php
	include("pass+.php");

	try{
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			
			$ItemName = $_POST['ItemName'];
			$Quantity = $_POST['Quantity'];
			$UnitPrice = $_POST['UnitPrice'];
			$Discount = $_POST['Discount'];
			$TotalPrice = $_POST['TotalPrice'];
			$QuoteID = $_POST['QuoteID'];




			$rs = $pdo->prepare("INSERT INTO lineItems (ItemName, Quantity, UnitPrice, Discount, TotalPrice, QuoteID) VALUES (:ItemName, :Quantity, :UnitPrice, :Discount, :TotalPrice, :QuoteID)");

			$rs->bindParam(':ItemName', $ItemName);
			$rs->bindParam(':Quantity', $Quantity);
			$rs->bindParam(':UnitPrice', $UnitPrice);
			$rs->bindParam(':Discount', $Discount);
			$rs->bindParam(':TotalPrice', $TotalPrice);
			$rs->bindParam(':QuoteID', $QuoteID);
			$rs->execute();


			$query = "SELECT itemQuantity FROM lineItem WHERE ItemName = $ItemName";
			$result = $pdo->prepare($query);
			$result->bindParam(':ItemName', $ItemName);
			$result->execute();

			if($result->rowCount() > 0){
				$row = $result->fetch(PDO::FETCH_ASSOC);

				$currentAmount = $row['itemQuantity'];

				$discountedAmount = $currentAmount - ($currentAmount * ($discount / 100));

				$update = "UPDATE lineItem SET itemQuantity = $discountedAmount WHERE id = $id";
				$updateResult = $pdo->prepare($update);
				$updateResult->bindParam(':discountedAmount',$discountedAmount);
				$updateResult->bindParam(':id', $id);
				$updatedResult->execute();

				echo "<br>";
				echo "Discount applied";
				echo "<br>";

			}else{

				echo "No row found with id = $id";
			}

			echo "<br>";			

			echo "New quote created. Press button to return:";


			echo "<br>";
			echo '<a href="sales_associate.php"><button>Sales Associate</button></a>';
		}
	}catch (PDOException $e){
		echo "Error: " . $e->getMessage();
	}
	

?>
</body>
</html>
