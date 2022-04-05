<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>
	<?php echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>"; ?>
	<?php echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/mystyle.css\" />"; ?>
	<?php echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/checkoutform.css\" />"; ?>
	
</head>
<body>

<?php
if (isset($_REQUEST['product_id'])) 
	{
		// If receive products ID then, retrive this ID in database
		$product_id = $_REQUEST['product_id'];
	
		// Store current product ID in session;
		$_SESSION["curr_product_id"] = $product_id;
		
		//Procedural style
		$connection = mysqli_connect('rerun', 'potiro', 'pcXZb(kL', 'poti');
	
		$query_string = "select * from products where (product_id = $ID)";
		 
		$result=mysqli_query($connection,$query_string);
		 
		$num_rows=mysqli_num_rows($result);
	
		if ($num_rows > 0 ) {
			
			if ( $a_row = mysqli_fetch_array($result))
			{										
				// talbe 
				echo "<table id='customers'>";
				echo "<tr>\n";
				echo "<th>product_id</th>";
				echo "<th>product_name</th>";
				echo "<th>unit_price</th>";
				echo "<th>unit_quantity</th>";
				echo "<th>in_stock</th>";
				echo "</tr>";

				echo "<tr>\n";
				echo "<td>$a_row[product_id]</td>";
				echo "<td>$a_row[product_name]</td>";
				echo "<td>$a_row[unit_price]</td>";
				echo "<td>$a_row[unit_quantity]</td>";
				echo "<td>$a_row[in_stock]</td>";
				echo "</tr>";

				echo "</table>";

				$_SESSION["selected_item"] = $a_row;

				echo '
				<div>
				<form action="cart--frame.php" method="get" target="cart--frame" onsubmit="return validate_quantity()">
					Quantity (between 1 and 20):
					<input type="number" id="quantity" name="quantity" min="1" value="1">
					<input type="submit" value="ADD">
				 </form>
				 </div>';
				 
			}
		}
		mysqli_close($link);	
	
	} 
	
	if( $_REQUEST["showcheckoutForm"] == 1 && (count($_SESSION["itmes"]) > 0) )
	{
		require('checkoutform.php');
	}

?>
</body>
</html>