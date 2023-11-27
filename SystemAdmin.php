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
	if (isset($_GET['Name']) && isset($_GET['Email']) && isset($_GET['Address']) && isset($_GET['Username']) && isset($_GET['Password'])){
		$Name = $_GET['Name'];
    		$Email = $_GET['Email'];
    		$Address = $_GET['Address'];
    		$Username = $_GET['Username'];
    		$Password = $_GET['Password'];

		$g = $pdo->prepare("INSERT INTO SalesAssociate (Name, Email, Address, Username, Password, commission, QuoteID) VALUES (:Name, :Email, :Address, :Username, :Password, 40.00, 1)");

		$g->bindParam(':Name', $Name);
    		$g->bindParam(':Email', $Email);
    		$g->bindParam(':Address', $Address);
    		$g->bindParam(':Username', $Username);
    		$g->bindParam(':Password', $Password);

		// Executing the prepared statement
    		$g->execute();
	}
		
	echo '<form action="" method="GET">
			<br><br>
			<h3>Please enter a name</h3>
			<input type="text" name="Name">

			<h3>Please enter a email</h3>
			<input type="text" name="Email">

			<h3>Please enter a address</h3>
			<input type="text" name="Address">

			<h3>Please enter a username</h3>
			<input type="text" name="Username">

			<h3>Please enter a password</h3>
			<input type="text" name="Password">

			<br>
			<button id="create" type="submit" name="create" value="create">Create</button
		</form>';
	
	echo "</body>";

echo "</body>";
?>
