<?php
//z-id
$username = "z1927111";
//yyyyMmmdd
$password = "2002Sep16";
//z-id
$dbname   = "z1927111"; 

try {
     $dsn = "mysql:host=courses;dbname={$dbname}";
     $pdo = new PDO($dsn, $username, $password);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOexception $e) {
     echo "Connection to database failed: " . $e->getMessage();
}

function draw_table($rows)
     {
       if(empty($rows)) {echo "<p>No results found.</p>";}
       	else
       	{
         	echo "<table border=1 cellspacing=1>";
         	echo "<tr>";
         	foreach($rows[0] as $key => $item)
         	{
           		echo "<th>$key</th>";
         	}
         	echo "</tr>";
         	foreach($rows as $row)
         	{	
           		echo "<tr>";
           		foreach($row as $key => $item)
           		{
             		echo "<td>$item</td>";
           		}
           		echo "</tr>";
         	}
         	echo "</table>";
       	}
     }
 function create_table($query) {
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
 }
?>
