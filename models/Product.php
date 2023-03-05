<?php

namespace app\models;

abstract class Product {

    protected string $sku;
    protected string $name;
    protected int $price;
    protected array $attributes = [];

    public function __construct($sku, $name, $price, $attributes) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->attributes = $attributes;
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
