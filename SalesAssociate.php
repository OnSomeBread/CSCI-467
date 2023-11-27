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
include("pass+.php");

//example redirect function
//header("Location: http://www.example.com/example-url", true, 301);

echo "<head>
     </head>";
echo "<body>";

//ERROR HERE
if (isset($_GET['Name']) && isset($_GET['Email']) && isset($_GET['Country']) && isset($_GET['Address']) && isset($_GET['QuoteID'])){
// TODO: Validate and sanitize input data
    $Name = $_GET['Name'];
    $Email = $_GET['Email'];
    $Country = $_GET['Country'];
    $Address = $_GET['Address'];
    $QuoteID = (int)$_GET['QuoteID'];

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
}
//ERROR HERE

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
//else {
//    // If the user is logged in, display the query interface
//    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//        // Process and execute the query
//        
//    }
//}

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

if($login == "correct"){
        echo '<form action="" method="GET">
			<br><br>
			<h3>Please enter a name</h3>
			<input type="text" name="Name">
			<h3>Please enter a email</h3>
			<input type="text" name="Email">
			<br>
   			<h3>Please enter a country</h3>
                        <input type="text" name="Country">
			<br>
   			<h3>Please enter a address</h3>
                        <input type="text" name="Address">
			<br>
   			<h3>Please enter a quoteid</h3>
                        <input type="text" name="QuoteID">
			<br>
			<button id="Enter" type="submit" name="Enter">Enter</button>
		</form>';
 
	// $query = $pdo->query("SELECT * FROM Quotes;");
	// echo '<table>';
	// 	while($row = $query->fetch(PDO::FETCH_ASSOC)){
	//                 echo "<tr>";
	//                 foreach($row as $col){
	//                     echo "<td>";
	//                     echo $col;
	//                     echo "</td>";
	//                 }
	//                 echo "</tr>";
	//         }
	// echo '</table>';

	echo "<title>Sales Associate</title><br><h1>Customer</h1>";

	$username='student';  //change
	$password='student'; //change

	try{
		$dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
		$pdo = new PDO($dsn,$username,$password);

		$rs = $pdo->query("SELECT name FROM customers;");
		$rows = $rs->fetchAll(PDO::FETCH_COLUMN); //fetch customer names
		//draw_table($rows);

		echo "\n";

		echo "<form method=POST action=  >";
		echo '<label for="customer">Select Customer:</label>'; 
		echo '<select id="customer" name="selected_customer">';
		foreach ($rows as $option){
			echo "<option value=\"$option\">$option</option>";			  }
		echo '<input type="submit" value="Submit">';
		echo '</select><br/>';	
		echo "</form>";	


	}
	catch(PDOexception $e){
		echo "Connection to database failed: ".$e->getMessage();
	}
}
?>
