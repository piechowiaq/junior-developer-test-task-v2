<?php

namespace app\models;

use app\core\Model;

abstract class Product extends Model
{

    protected string $sku;
    protected string $name;
    protected string $price;


    public function __construct($sku, $name, $price) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;

    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price . " $";
    }

    abstract public function getAttributes();
}
