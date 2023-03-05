<?php

namespace app\models;

class Book extends Product
{
    private array $attributes = [];

    public function __construct($sku,$name, $price, $attributes) {
        parent::__construct($sku, $name, $price);
        $this->attributes = $attributes;
    }

    public function getAttributes()
    {
        return "Weight: " . $this->attributes['weight'] . " KG";
    }
}