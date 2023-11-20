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

if (!isset($_SESSION['username'])) {
    // If not logged in, check if the login form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check username and password against the database
        $query = "SELECT * FROM SalesAssociate WHERE Username='$username' AND Password='$password'";
        $result = $pdo->query($query);

        if ($result->num_rows > 0) {
            // If credentials are valid, store the username in the session
            $_SESSION['username'] = $username;
        } else {
            $loginError = "Invalid username or password";
		echo $loginError;
        }
    }
} else {
    // If the user is logged in, display the query interface
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process and execute the query
        $queryText = $_POST['query'];
        $result = $pdo->query($conn, $queryText);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    }
}


//if(!isset($_GET['login'])) {
	echo '<form action="" method="POST">
		<br><br>
		<h3>Please enter a username</h3>
		<input type="text" name="username" value="username">
		<h3>Please enter a password</h3>
		<input type="text" name="password" value="password">
		<br>
		<input type="text" name="" value="">
		<br>
		<button id="login" type="submit" name="login" value="login">Login</button
	</form>';
//}

$query = $pdo->query("SELECT * FROM Quotes;");
echo '<table>';
	while($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                foreach($row as $col){
                    echo "<td>";
                    echo $col;
                    echo "</td>";
                }
                echo "</tr>";
            }
        echo '</table>';
echo "</body>";
?>
