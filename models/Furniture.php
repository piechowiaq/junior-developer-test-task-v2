<?php

namespace app\models;

class Furniture extends Product
{
    protected $attributes;

    public function __construct($id, $sku, $name, $price, $attributes) {
        parent::__construct($id, $sku, $name, $price);
        $this->attributes = $attributes;

    }

    public function getAttributes(): string
    {
        return "Dimension: " . $this->attributes['height'] . "x" . $this->attributes['width'] . "x" . $this->attributes['length'];
    }

    public function setAttributes($attributes): string
    {
        $this->attributes = $attributes;
    }

    public function save()
    {
        parent::save();

        $query = 'INSERT INTO furnitures (id, height, width, length) VALUES (:id, :height, :width, :length)';

        $stmt = self::prepare($query);

        $stmt->bindValue(':id', $this->getId());
        $stmt->bindValue(':height',$this->attributes['height']);
        $stmt->bindValue(':width',$this->attributes['width']);
        $stmt->bindValue(':length',$this->attributes['length']);
        $stmt->execute();

        return true;
    }




}