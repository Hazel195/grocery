<?php
	session_start();

	if (!isset($_SESSION['item_list']) ){
		
		$item_id = $_SESSION['selected_item'][product_id];
		$_SESSION["item_list"][$id][product_id] = $_SESSION["selected_item"][product_id];
		$_SESSION["item_list"][$id][product_name] = $_SESSION["selected_item"][product_name];
		$_SESSION["item_list"][$id][unit_price] = $_SESSION["selected_item"][unit_price];
		$_SESSION["item_list"][$id][unit_quantity] = $_SESSION["selected_item"][unit_quantity];
		$_SESSION["item_list"][$id][quantity] = $_REQUEST["quantity"];
	}


	 else {
		$search_id = $_SESSION['selected_item'][product_id];
		$found = false;

		foreach($_SESSION['item_list'] as $curr) {
			while(!$found) {
				
				if (($curr['product_id'] == $search_id)) {
					$_SESSION['item_list'][$search_id][unit_quantity] += $_REQUEST["quantity"];
					$found = true;

					//break;
				}
			}
		}

	}

	if ($_REQUEST['clear_all']) {
		unset($_SESSION['selected_item']);
		unset($_SESSION['check_out']);
		unset($_SESSION['item_list']);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
	foreach($_SESSION['item_list'] as $curr) {?> 
		<p><a href="#"> <?php echo $curr['product_name'];?></a> <?php echo $curr['qunatity'];?> <?php echo $curr['unit_price']; ?> <?php echo $curr['quantity'];?></p>
	<?php } ?>
	<a href="cart--frame.php?clear=true" target="cart-frame">CLEAR LIST</a>
	<a href="cart--frame.php?check_out=true" target="product--frame">CHECK OUT</a>

	<h1>Total $
	<?php $sum = 0;
	foreach($_SESSION['item_list'] as $curr) 
		$sum += $curr['unit_price'] * $curr['quantity'];
	echo $sum; ?></h1>



</body>
</html>