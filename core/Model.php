<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_UNIQUE = 'unique';
    public const RULE_INT = 'int';

    abstract public function rules();

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules){
            $value = $this->{$attribute};
            foreach ($rules as $rule){
                $ruleName = $rule;
                if(!is_string($ruleName)){
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value){

                }
            }
        }
    }

}