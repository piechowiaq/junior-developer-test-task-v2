<?php

namespace app\models;

class Book implements Product
{
    private string $sku;
    private string $name;
    private int $price;
    private int $weight;

    public function __construct($sku,$name, $price, $weight) {

        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;

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