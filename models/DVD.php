<?php

namespace app\models;

class DVD extends Product
{
    public array $attributes = [];

    public function __construct($sku,$name, $price, $attributes) {
        parent::__construct($sku, $name, $price);
        $this->attributes = $attributes;
    }

    public function validate()
    {
        parent::validate(); // Run parent validation rules

        // Add additional validation rules for Product class
        $attributes = $this->attributes;

        foreach ($attributes as $key => $value) {
            if (!($value)) {
                $errors[$key] = 'Please, submit required '.$key;
            }
        }
    }

    public function getAttributes()
    {
        return "Size: " . $this->attributes['size'] . " MB";
    }

    public function rules(): array
    {
        return [
            parent::rules(),
            'attributes' => [self::RULE_REQUIRED],

        ];
    }
}