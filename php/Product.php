<?php

public class Product {
    public $product_id;
    private $product_name;
    private $unit_price;
    private $unit_quantity;
    private $in_stock;

    function __construct($product_id, $product_name, $unit_price, $unit_quantity, $in_stock) {
        $this->$product_id = $product_id;
        $this->$product_name = $product_name;
        $this->$unit_price = $unit_price;
        $this->$unit_quantity = $unit_quantity;
        $this->$in_stock = $in_stock;
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


?>