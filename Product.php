<?php

class Product {
    private $product_id;
    private $product_name;
    private $unit_price;
    private $unit_quantity;
    private $in_stock;

    function __construct($product_id, $product_name, $unit_price, $unit_quantity, $in_stock) {
        $this->$product_id = $product_id;
        $this->$product_name = $product_name;
        $this->$unit_price = $unit_price;
        $this->unit_quantity = $unit_quantity;
        $this->in_stock = in_stock;
    }
}


?>