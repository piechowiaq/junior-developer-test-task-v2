<?php

namespace app\models;

abstract class Product
{
    public const RULE_REQUIRED = 'required';
    public const RULE_UNIQUE = 'unique';
    public const RULE_INT = 'int';

    protected string $sku;
    protected string $name;
    protected string $price;
    protected array $attributes;

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

    public function validate(): array
    {
        $errors = [];

        if (!$this->sku){
            $errors['sku'] = 'Please, submit required SKU';
        }

        if (!$this->name){
            $errors['name'] = 'Please, submit required name';
        }

        if (!$this->price){
            $errors['price'] = 'Please, submit required price';
        }

        if (!is_numeric($this->price)){
            $errors['price'] = 'Please, submit numeric price';
        }

        foreach ($this->attributes as $key => $value) {
                if (!($value)) {
                    $errors[$key] = 'Please, submit required '.$key;
                }
        }

        foreach ($this->attributes as $key => $value) {
            if (!is_numeric($value)) {
                $errors[$key] = 'Please, submit numeric '.$key;
            }
        }

        return $errors;
    }



}
