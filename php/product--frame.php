<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CART</title>
</head>
<body>


    <?php
    
    if (!isset($_REQUEST['data'])) {
        echo "ERROR";
    } else {
        $product_id = $_REQUEST['data'];

        $_SESSION["selected_id"] = $product_id;

        $conn = mysqli_connect('localhost', 'uts', 'internet', 'assignment1');
        
        $q = "select * from products where (product_id = $product_id)";

        $result = mysqli_query($conn, $q);
        
        $a_row = mysqli_fetch_array($result);
        
        echo $product_id." successfully loaded";
        echo $a_row[product_id];

        $num_rows = mysqli_num_rows($result);
        
        
        if ($num_rows > 0 ) {
										
				
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

				$_SESSION["currentProduct"] = $a_row;

                $add_string = '
				<div>
				<form action="cart--frame.php" method="get" target="cart--frame" onsubmit="return is validate()">
					Product Quantity :
					<input type="number" id="qty" name="qty" min="1" max="20" value="1">
					<input type="submit" value="ADD">
				 </form>
				 </div>';

				echo $add_string;
				 
			}
		
		
    }

    ?>

<script>
    function is_validate() {
        var qty = document.getElementByID("qty").value;

        if (qty > 20 || qty < 1) {
            return false;
        }
        return true;
    }

</script>


</body>
</html>