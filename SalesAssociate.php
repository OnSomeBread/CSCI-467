<img src="">
<form action="" method="GET">
	<br><br>
	<h3>Please enter a username</h3>
	<input type="text" name="username" value="">
	<h3>Please enter a password</h3>
	<input type="text" name="password" value="">
	<br>
	<input type="text" name="" value="">
</form>
<?php
include("pass+.php");

//example redirect function
//header("Location: http://www.example.com/example-url", true, 301);

echo "<head>
     </head>";
echo "<body>";

$query = $pdo->query("SELECT * FROM Quotes;");
echo '<table>';
	while($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo "<tr id=$i onclick='highlight(this)'>";
                
                // gets every col form result
                $j = 0;
                foreach($row as $col){
                    $h = $i . $j . "d";
                    echo "<td id=$h>";
                    echo $col;
                    echo "</td>";
                    $j = $j + 1;
                }
                echo "</tr>";
                $i = $i + 1;
            }

        echo '</table>';
echo "</body>";
?>
