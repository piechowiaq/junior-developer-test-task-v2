<?php

namespace app\models;

class DVD extends Product
{
    public function __construct($sku,$name, $price, $attributes) {
        parent::__construct($sku, $name, $price, $attributes);

    }

    public function getAttributes(): string
    {
        return "Size: " . $this->attributes['size'] . " MB";
    }

}