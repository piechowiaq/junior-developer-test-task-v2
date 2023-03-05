<?php

namespace app\models;

class DVD extends Product
{
    private int $size;

    public function __construct($sku,$name, $price, $size) {
        parent::__construct($sku, $name, $price, []);
        $this->size = $size;
    }

    public function getAttributes()
    {
        return "Size: " . $this->size . " MB";
    }
}