<?php

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
    
    function setQuantity($quantity) {
      $this->quantity = $quantity;
    }
}


?>