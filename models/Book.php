<?php

namespace app\models;

class Book extends Product
{
    protected $attributes;

    public function __construct($sku, $name, $price, $attributes) {
        parent::__construct($sku, $name, $price);
        $this->attributes = $attributes;

    }

    public function getAttributes(): string
    {
        return "Weight: " . $this->attributes['weight'] . " KG";
    }

    public function setAttributes($attributes): string
    {
        $this->attributes = $attributes;
    }

    public function save()
    {
        parent::save();

        $query = 'INSERT INTO books (id, weight) VALUES (:id, :weight)';

        $stmt = self::prepare($query);

        $stmt->bindValue(':id', $this->getId());

//        echo '<pre>';
//        var_dump();
//        echo '</pre>';
//        exit;

        $stmt->bindValue(':weight',$this->attributes['weight']);

        $stmt->execute();

        return true;
    }
}