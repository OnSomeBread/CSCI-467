<?php

include("pass+.php");

echo "<head>
	<title>
		System Administration
	</title>
</head>";

echo "<body>";
	echo '<h1>Create a new Sales Associate user</h1>';

	//new sales associate creation
	if (isset($_GET['create']) && isset($_GET['Name']) && isset($_GET['Email']) && isset($_GET['Address']) && isset($_GET['Username']) && isset($_GET['Password'])){
		$Name = $_GET['Name'];
    		$Email = $_GET['Email'];
    		$Address = $_GET['Address'];
    		$Username = $_GET['Username'];
    		$Password = $_GET['Password'];

		if(!empty($_GET['Username'])) {
			$g = $pdo->prepare("INSERT INTO SalesAssociate (Name, Email, Address, Username, Password, commission, QuoteID) VALUES (:Name, :Email, :Address, :Username, :Password, 40.00, 1)");
		
		$g->bindParam(':Name', $Name);
    		$g->bindParam(':Email', $Email);
    		$g->bindParam(':Address', $Address);
    		$g->bindParam(':Username', $Username);
    		$g->bindParam(':Password', $Password);

		try {
    			$g->execute();
		}
		catch (Exception $e) {
			echo 'failure';
		}
		}
	}

	if (isset($_GET['delete']) && isset($_GET['UserID'])){
		$DelUser = $_GET['UserID'];
		$b = $pdo->prepare("DELETE FROM SalesAssociate WHERE AssocID = :DelUser;");
		$b->bindParam(':DelUser', $DelUser);
		$b->execute();
	}
		
	echo '<form action="" method="GET">
			<br><br>
			<h3>Please Enter a Name</h3>
			<input type="text" name="Name">

			<h3>Please Enter an Email</h3>
			<input type="text" name="Email">

			<h3>Please Enter an Address</h3>
			<input type="text" name="Address">

			<h3>Please Enter a Username</h3>
			<input type="text" name="Username">

			<h3>Please Enter a Password</h3>
			<input type="text" name="Password">

			<br>
			<button id="create" type="submit" name="create" value="create">Create</button
		</form>';

		echo '<form action="" method="GET">
  			<br><br>
			<h3>Please Enter UserID to Delete</h3>
			<input type="text" name="UserID">
   			<br>
			<button id="delete" type="submit" name="delete">Delete</button
  		</form>';

	$query = $pdo->query("SELECT * FROM SalesAssociate;");
        create_table($query);

		echo '<form action="" method="GET">
  			<br><br>
			<h3>Please Enter UserID to Edit</h3>
			<input type="text" name="UserID">
   			<br>
			<button id="edit" type="submit" name="edit">Edit</button
  		</form>';
	
	echo "</body>";

echo "</body>";
?>
