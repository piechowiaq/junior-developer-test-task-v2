<?php

namespace app\models;

class DVD extends Product
{
    protected $attributes;

    public function __construct($id, $sku, $name, $price, $attributes) {
        parent::__construct($id, $sku, $name, $price);
        $this->attributes = $attributes;

    }

    public function getAttributes(): string
    {
        return "Size: " . $this->attributes['size'] . " MB";
    }

    public function setAttributes($attributes): string
    {
        $this->attributes = $attributes;
    }

    public function save()
    {
        parent::save();

        $query = 'INSERT INTO dvds (id, size) VALUES (:id, :size)';

        $stmt = self::prepare($query);

        $stmt->bindValue(':id', $this->getId());
        $stmt->bindValue(':size',$this->attributes['size']);
        $stmt->execute();

        return true;
    }

}