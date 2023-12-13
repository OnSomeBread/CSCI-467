<html>
<head>
	<style>
		body{
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
			margin: 0;
			padding: 0;
			display: flex;
            		flex-direction: column;
            		align-items: center;
			min-height: 100vh;
		}

		header {
            		background-color: #2ecc71;
            		color: #fff;
            		padding: 10px;
            		text-align: left;
            		width: 100%;
            		box-sizing: border-box;
		}

       		button {
            		padding: 10px 20px;
            		font-size: 16px;
            		cursor: pointer;
            		background-color: #3498db;
            		color: #fff;
            		border: none;
            		border-radius: 5px;
        	}

        	button:hover {
            		background-color: #2980b9;
		}
	</style>
</head>
<body>

	<header>
		<h1>Plant Repair Service</h1>
	</header>	


<?php
//Entire page is a basic button prompt page that allows a user to naviate with ease.
	echo "<br>";			

	echo "<h2>Sales Associate:</h2>";

	echo '<a href="SalesAssociate.php"><button>Sales Associate</button></a>';

	echo "<br>";

	echo "<h2>Management:</h2>";

	echo '<a href="Management.php"><button>Management</button></a>';

	echo "<br>";

	echo "<h2>Order Confirmation page:</h2>";

	echo '<a href="OrderConfirmation.php"><button>Order Conformation</button></a>';

	echo "<br>";

	echo "<h2>System Admin:</h2>";

	echo '<a href="SystemAdmin.php"><button>System Admin</button></a>';

	echo "<br>";

?>
</body>
</html>
