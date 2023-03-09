<?php

namespace app\models;

class Furniture extends Product
{

    public function __construct($sku,$name, $price, $attributes) {
        parent::__construct($sku, $name, $price, $attributes);

    }

    public function getAttributes(): string
    {
        return "Dimension: " . $this->attributes['height'] . "x" . $this->attributes['width'] . "x" . $this->attributes['length'];
    }

}