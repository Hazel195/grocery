<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>CART</title>
</head>
<body>
    <div class="body--div">
<?php
    require_once('Product.php');
    
    if (!isset($_REQUEST['data'])) {
        echo "";
    } else {
        $selected_id = $_REQUEST['data'];

        $_SESSION["selected_ID"] = $selected_id;

		$conn = mysqli_connect('aa1v4eqka9379uz.cns4nwpeuyv6.us-east-1.rds.amazonaws.com:3306', 'uts', 'internet', 'assignment1');
        
        $q = "select * from products where (product_id = $selected_id)";

        $result = mysqli_query($conn, $q);
        
        $a_row = mysqli_fetch_array($result);

        $num_rows = mysqli_num_rows($result);
        
        $_SESSION['new_item_row'] = $a_row;
        $product_id = $a_row['product_id'];
        $new_item = new Product($a_row['product_id'], $a_row['product_name'], $a_row['unit_price'], $a_row['unit_quantity'],$a_row['in_stock']);
        
        

    ?>
    <div class="left--div--1">
        
        <?php
        echo "<img src=../img/nav--";
        echo intval($new_item->product_id/1000);
        echo "/";
        echo $new_item->product_id;
        echo ".png width=180/>";
        ?>
        
        </div>
        <div class="right--div--1">
            
        <?php
		echo "<h1># ";
		echo $new_item->product_id;
		echo "<br>";
		echo " $new_item->product_name";
		echo "</h1>";
        
        
        if ($num_rows > 0 ) {
        ?>
        

        <table>
        
        <?php
				echo "<tr>\n";
				echo "<th>Unit Price</th>";
				echo "<td>$new_item->unit_price</td></tr>";
				echo "<tr>\n";
				echo "<th>Unit Quantity</th>";
				echo "<td>$new_item->unit_quantity</td></tr>";
				echo "<tr>\n";
				echo "<th>In Stock</th>";
				echo "<td>$new_item->in_stock</td>";
				echo "</tr>";
				echo "<br>";
				?>
				
		</table>
		<br>
		
		<?php
                
			    $_SESSION["selected_item"] = $a_row;
                
               
				/*echo '<div>
				<form action="cart--frame.php" method="get" target="cart--frame" onsubmit="return is_valid()">
					Quantity (between 1 and 20):
					<input type="number" id="quantity" name="quantity" min="1" max="20" value="1">
					<input type="submit" value="ADD">
				 </form>
				 </div>';*/
				 
			}
    
		
    }

    ?>

    <div>
        <?php
            if(isset($_REQUEST['data'])) {
    
				echo '<form action="cart--frame.php" method="get" target="cart--frame" onsubmit="return is_valid()">
					Quantity (1~20):
					<input type="number" id="quantity" name="quantity" min="1" max="20" value="1">
					<input type="submit" id="add--button" value="ADD">
				 </form>';
				 } ?>
	</div>
	</div>
	<?php
	if( $_REQUEST["checkout_clicked"] == 1 && (count($_SESSION["itmes"]) > 0) )
	{
		require('checkout.php');
	}?>

<script>
    function is_valid() {
        var qty = document.getElementByID("quantity").value;

        if (qty > 20 || qty < 1) {
            return false;
        }
        return true;
    }

</script>
</div>

</body>
</html>