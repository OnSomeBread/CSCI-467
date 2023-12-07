<style>
    * {
        box-sizing: border-box;
    }

    .container {
        text-align: center;
    }

    .table-container {
        display: inline-block;
        text-align: center;
        margin: 10px;
    }

     header-container{
	text-align: left;
     }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #fffff;
        margin-top: 10px;
    }

    th, td {
        text-align: left;
        padding: 16px;
    }	
</style>
<?php
include("styles.css");
include("pass+.php");

echo "<head>
	<title>
		System Administration
	</title>
</head>";

echo "<body>";
	echo '<h1>Create a New Sales Associate</h1>';

	//new sales associate creation
	if (isset($_GET['create']) && isset($_GET['Name']) && isset($_GET['Email']) && isset($_GET['Address']) && isset($_GET['Username']) && isset($_GET['Password'])){
		$Name = $_GET['Name'];
    		$Email = $_GET['Email'];
    		$Address = $_GET['Address'];
    		$Username = $_GET['Username'];
    		$Password = $_GET['Password'];
		$Commission = $_GET['commission'];

		if(!empty($_GET['Username'])) {
			$g = $pdo->prepare("INSERT INTO SalesAssociate (Name, Email, Address, Username, Password, commission) VALUES (:Name, :Email, :Address, :Username, :Password, :Commission)");
		
		$g->bindParam(':Name', $Name);
    		$g->bindParam(':Email', $Email);
    		$g->bindParam(':Address', $Address);
    		$g->bindParam(':Username', $Username);
    		$g->bindParam(':Password', $Password);
		$g->bindParam(':Commission', $Commission);

		try {
    			$g->execute();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		}
	}

	if (isset($_GET['delete']) && isset($_GET['UserID'])){
		$DelUser = $_GET['UserID'];
		$b = $pdo->prepare("DELETE FROM SalesAssociate WHERE AssocID = :DelUser;");
		$b->bindParam(':DelUser', $DelUser);
		$b->execute();
	}

	if (isset($_GET['edit'])){
		// change update line
		$b = $pdo->prepare("UPDATE SalesAssociate SET Name=:n_name, Email=:n_email, Address=:n_address, 
  			Username=:n_username, Password=:n_password, commission=:n_commission WHERE AssocID=:AssocID;");
		$b->bindParam(':n_name', $_GET['newname']);
		$b->bindParam(':n_email', $_GET['newemail']);
		$b->bindParam(':n_address', $_GET['newaddress']);
		$b->bindParam(':n_username', $_GET['newusername']);
		$b->bindParam(':n_password', $_GET['newpassword']);
		$b->bindParam(':n_commission', $_GET['newcommission']);
		$b->bindParam(':AssocID', $_GET['associd']);
		// try block to stop from crashing
		// try {
		 	$b->execute();
		// }
		// catch (Exception $e) {
		// 	echo "Invalid edit inputs";
		// }
	}
		
	echo '<form action="" method="GET">
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

			<h3>Enter Commission Rate</h3>
   			<input type="text" name="commission">

			<br>
			<button id="create" type="submit" name="create" value="create">Create</button>
		</form>';

		echo '<form action="" method="GET">
			<h3>Please Enter UserID to Delete</h3>
			<input type="text" name="UserID">
			<button id="delete" type="submit" name="delete">Delete</button>
  		</form>';

		echo '<form action="" method="GET">
			<h3>Please Enter Associate ID Information</h3>
			<input type="text" name="associd">
   			<br>
			<h3>Enter a New Name</h3>
			<input type="text" name="newname">
			<h3>Enter a New Email</h3>
			<input type="text" name="newemail">
			<h3>Enter a New Address</h3>
			<input type="text" name="newaddress">
			<h3>Enter a New Username</h3>
			<input type="text" name="newusername">
			<h3>Enter a New Password</h3>
			<input type="text" name="newpassword">
			<h3>Enter a New Commission Rate</h3>
			<input type="text" name="newcommission">
			<button id="edit" type="submit" name="edit">Edit</button>
  		</form>';


		echo '<div class="container">';
			echo '<div class="table-container">';
				echo '<h2>Current Sales Associates</h2>';
				$query = $pdo->query("SELECT * FROM SalesAssociate;");
				create_table($query);
			echo '</div>';
		echo '</div>';
		
		echo "<br></br>";

		echo '<div class="container">';
			echo '<div class="header-container">';
				echo '<h2>Current Quotes</h2>';
			echo '</div>';

			$query1 = $pdo->query("SHOW COLUMNS FROM Quotes;");
			$columns = $query1->fetchAll(PDO::FETCH_COLUMN);
			
			echo '<table>';
				echo '<tr>';
					foreach ($columns as $column) {
						echo '<div class="header-container">';
					    		echo '<th class="table-label">' . $column . '</th>';
						echo '</div>';
					}
				echo '</tr>';
	
				echo '<div class="table-container">';
					$query1 = $pdo->query("SELECT * FROM Quotes;");
					create_table($query1);
				echo '</div>';
			echo '</table>';
		echo '</div>';
echo "</body>";
?>
