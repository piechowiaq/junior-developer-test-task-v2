<?php

namespace app\models;

class Book extends Product
{
    private array $attributes = [];

    public function __construct($sku,$name, $price, $attributes) {
        parent::__construct($sku, $name, $price);
        $this->attributes = $attributes;
    }

    public function getAttributes(): string
    {
        return "Weight: " . $this->attributes['weight'] . " KG";
    }

    public function rules(): array
    {
        return [
          'name' => [self::RULE_REQUIRED],
          'sku' => [self::RULE_REQUIRED, self::RULE_UNIQUE],
          'price' => [self::RULE_REQUIRED, self::RULE_INT],
          'size' => [self::RULE_REQUIRED, self::RULE_INT]
        ];
    }
}