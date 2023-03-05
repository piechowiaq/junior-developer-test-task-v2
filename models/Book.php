<?php

namespace app\models;

class Book extends Product
{
    private int $weight;

    public function __construct($sku,$name, $price, $weight) {
        parent::__construct($sku, $name, $price, []);
        $this->weight = $weight;
    }

    public function getAttributes()
    {
        return "Weight: " . $this->weight . " KG";
    }
}