<?php

namespace app\models;

class Book extends Product
{
    public function __construct($sku,$name, $price, $attributes) {
        parent::__construct($sku, $name, $price, $attributes);

    }

    public function getAttributes(): string
    {
        return "Weight: " . $this->attributes['weight'] . " KG";
    }
}