<?php

namespace app\models;

class Furniture implements Product
{
    private string $sku;
    private string $name;
    private int $price;
    private int $height;
    private int $width;
    private int $length;

    public function __construct($sku,$name, $price, $height, $width, $length) {

        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;

    }

    public function getSku()
    {
        // TODO: Implement getSku() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }

    public function getPrice()
    {
        // TODO: Implement getPrice() method.
    }

    public function getAttributes()
    {
        // TODO: Implement getAttributes() method.
    }
}