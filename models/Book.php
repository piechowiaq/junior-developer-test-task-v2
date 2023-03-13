<?php

namespace app\models;

class Book extends Product
{
    public function __construct($sku,$name, $price, $attributes, $productType) {
        parent::__construct($sku, $name, $price, $attributes, $productType);

    }

    public function getAttributes(): string
    {
        return "Weight: " . $this->attributes['weight'] . " KG";
    }
}