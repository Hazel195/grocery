<?php

session_start();

class Product {
    public $product_id;
    public $product_name;
    public $unit_price;
    public $unit_quantity;
    public $in_stock;
    public $quantity;

    function __construct($product_id, $product_name, $unit_price, $unit_quantity, $in_stock) {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->unit_price = $unit_price;
        $this->unit_quantity = $unit_quantity;
        $this->in_stock = $in_stock;
        $this->quantity = $quantity;
    }
    
    function setQuantity($quantity) {
      $this->quantity = $quantity;
    }
    
    function getCost() {
      return $unit_price * $quantity;
    }

    function getID() {
        return $product_id;
    }

    function getName() {
        return $product_name;
    }

    function getPrice() {
        return $unit_price;
    }

    function getQuantity() {
        return $unit_quantity;
    }

    function getInStock() {
        return $in_stock;
    }
}



$a_row = $_SESSION['new_item_row'];
//$new_item = new Product($a_row['product_id'], $a_row['product_name'], $a_row['unit_price'], $a_row['unit_quantity'],$a_row['in_stock']);


if(isset($a_row) && $_REQUEST["quantity"] > 0){

  if (!isset($_SESSION["itmes"])) {  
 
      $id = $a_row['product_id']; //$_SESSION['new_item'][product_id];
      
      $_SESSION["itmes"][$id] = new Product($a_row['product_id'], $a_row['product_name'], $a_row['unit_price'], $a_row['unit_quantity'],$a_row['in_stock']);
      $_SESSION["itmes"][$id] -> setQuantity($_REQUEST["quantity"]);//quantity = $_REQUEST["quantity"];
      
      
      
     /* $_SESSION["itmes"][$id][product_id] = $new_item->product_id;
      $_SESSION["itmes"][$id][product_name] = $new_item->product_name;
      $_SESSION["itmes"][$id][unit_price] = $new_item->unit_price;
      $_SESSION["itmes"][$id][unit_quantity] = $new_item->unit_quantity;
      $_SESSION["itmes"][$id][quantity] = $_REQUEST["quantity"];*/

  }else
  {
    $serchid = $a_row['product_id'];
    $find = 0;

      foreach ($_SESSION["itmes"] as $item) {
        if ($item->product_id == $serchid) {    
          //Update quntity
          $updated_qty = $_SESSION["itmes"][$serchid]->quantity + $_REQUEST["quantity"];
          $_SESSION["itmes"][$serchid]->setQuantity($updated_qty);
          //$t = $_SESSION["itmes"][$serchid]->quantity;

          $find = 1;
          break;
        }

      }

      if ($find == 0) {
        $id = $a_row['product_id'];  
        $_SESSION["itmes"][$id] = new Product($a_row['product_id'], $a_row['product_name'], $a_row['unit_price'], $a_row['unit_quantity'],$a_row['in_stock']);
        $_SESSION["itmes"][$id] ->setQuantity($_REQUEST["quantity"]);
        /*$_SESSION["itmes"][$id]-product_id] = $_SESSION["selected_item"][product_id];
        $_SESSION["itmes"][$id][product_name] = $_SESSION["selected_item"][product_name];
        $_SESSION["itmes"][$id][unit_price] = $_SESSION["selected_item"][unit_price];
        $_SESSION["itmes"][$id][unit_quantity] = $_SESSION["selected_item"][unit_quantity];
        $_SESSION["itmes"][$id][quantity] = $_REQUEST["quantity"];*/
       // echo "new id is:".$id."<br>";
      }

      $number = 0;
      foreach ($_SESSION["itmes"] as $item){
       // echo $item[product_id]."...$item[quantity]"."</br>";
        $number += $item->quantity;
      }
    }

} 
      $total_number = 0;
      foreach ($_SESSION["itmes"] as $item){
        $total_number += $item->quantity;
      }
      $_SESSION["total"]["number"] = $total_number;
      
  if ($_REQUEST["clear"] == 1) {
    unset($_SESSION["selected_item"]);
    unset($_SESSION['checkout_clicked']);
    unset($_SESSION['itmes']);
    unset($total_number);
    unset($_SESSION['new_item']);
    unset($new_item);
    unset($_SESSION['total']);
    
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css" />
	<title>Document</title>
</head>
<body>
 
<div id="info-banner" style="display:none" class="alert alert-info">
  <strong>Note:</strong> No items! 
  <br>Click 'CHECKOUT' button to hide this information.
</div>

<a href="cart--frame.php?clear=1" target="cart--frame" class="button" style="float:right">CLEAR</a>
<a  href="checkout.php?checkout_clicked=1" class="button" target="product--frame" >CHECKOUT</a>
<hr>

<div class="row">
<div class="col-25" >
  <div class="container">
    <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i><b id='number-itmes'><?php echo $total_number;?></b></span></h4>
  
  <?php 
    foreach($_SESSION["itmes"] as $product){ 
    if ($product->unit_price != 0){?>
      <p><?php echo $product->product_name;?> X <?php echo $product->quantity;?><span class="price">$<?php echo $product->unit_price*$product->quantity;?></span></p>
  <?php }} ?>

    <hr>

    <p>Total <span class="price" style="color:black"><b>$
    <?php
    $total = 0;
    foreach($_SESSION["itmes"] as $product){
      //$total += $product["unit_price"]*$product["quantity"];
      $total += $product->unit_price * $product->quantity;
    }
    echo $total;
    $_SESSION["total"]["cost"] = $total;
    ?></b></span></p>
  </div>
</div>
</div>


</body>
</html>