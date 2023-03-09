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

    public function rules(): array
    {
        return [
            'sku' => [self::RULE_REQUIRED],
            'name' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED],
        ];
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules){
            $value = $this->{$attribute};
            foreach ($rules as $rule){
                $ruleName = $rule;
                if(!is_string($ruleName)){
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }

            }
        }
        return empty($this->errors);
    }

    private function addErrorForRule(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';

        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_UNIQUE => 'Record with this {field} already exist',
        ];
    }
}
