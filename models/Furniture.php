<?php

namespace app\models;

class Furniture extends Product
{
    private int $height;
    private int $width;
    private int $length;

    public function __construct($sku,$name, $price, $height, $width, $length) {
        parent::__construct($sku, $name, $price, []);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getAttributes()
    {
        return "Dimension: " . $this->height . "x" . $this->width . "x" . $this->length;
    }

}