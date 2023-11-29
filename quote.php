<html><head><title>Quote</title>
</head>
<body>
<?php

	try{
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			
			$id = $_POST['id'];
			$email = $_POST['email'];
			$itemName = $_POST['itemName'];
			$itemQuantity = $_POST['itemQuantity'];
			$note = $_POST['note'];
			$discount = $_POST['discount'];


			$pdo = new PDO("mysql:host=courses;dbname=z1873203","z1873203","2001Jul31");



			$rs = $pdo->prepare("INSERT INTO lineItem (email, itemName, itemQuantity, note, customer_name, id) VALUES (:email, :itemName, :itemQuantity, :note, :customer_name, :id)");

			$rs->bindParam(':email', $email);
			$rs->bindParam(':itemName', $itemName);
			$rs->bindParam(':itemQuantity', $itemQuantity);
			$rs->bindParam(':note', $note);
			$rs->bindParam(':customer_name', $customer);
			$rs->bindParam(':id', $id);
			$rs->execute();


			$query = "SELECT itemQuantity FROM lineItem WHERE id = $id";
			$result = $pdo->prepare($query);
			$result->bindParam(':id', $id);
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
