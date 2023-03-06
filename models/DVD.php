<?php

namespace app\models;

class DVD extends Product
{
    public array $attributes = [];

    public function __construct($sku,$name, $price, $attributes) {
        parent::__construct($sku, $name, $price);
        $this->attributes = $attributes;
    }

    public function getAttributes()
    {
        return "Size: " . $this->attributes['size'] . " MB";
    }

    public function rules()
    {
        // TODO: Implement rules() method.
    }
}