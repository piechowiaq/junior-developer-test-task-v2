<?php

namespace app\models;

use app\core\Application;

class DVD extends Product
{
    protected $attributes;

    public function getAttributes(): string
    {
        return "Size: " . $this->attributes['size'] . " MB";
    }

    public function setAttributes($attributes): string
    {
        $this->attributes = $attributes;
    }

    public function validate(): array
    {
        $errors = parent::validate();

        if(!is_null($this->attributes)) {

            foreach ($this->attributes as $key => $value) {
                if ($value) {
                    $errors[$key] = 'Please, submit required ' . $key . '.';
                }
            }

            foreach ($this->attributes as $key => $value) {
                if (!is_numeric($value)) {
                    $errors[$key] = 'Please, submit numeric ' . $key . '.';
                }
            }

            return $errors;
        }

        return $errors;
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