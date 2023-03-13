<?php

namespace app\models;

class DVD extends Product
{
    public function __construct($sku,$name, $price, $attributes, $productType) {
        parent::__construct($sku, $name, $price, $attributes, $productType);

    }

    public function getAttributes(): string
    {
        return "Size: " . $this->attributes['size'] . " MB";
    }

}