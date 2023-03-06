<?php

namespace app\models;

class Furniture extends Product
{
    public array $attributes =[];

    public function __construct($sku,$name, $price, $attributes) {
        parent::__construct($sku, $name, $price);
        $this->attributes = $attributes;

       }

    public function getAttributes()
    {
        return "Dimension: " . $this->attributes['height'] . "x" . $this->attributes['width'] . "x" . $this->attributes['length'];
    }

    public function rules()
    {
        // TODO: Implement rules() method.
    }
}