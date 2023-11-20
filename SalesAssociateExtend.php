<html><head><title>Sales Associate</title></head><body>
<?php
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
	
	echo "<h1>Customer</h1>";

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
	






?>

</pre></body></html>
