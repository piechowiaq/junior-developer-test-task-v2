<?php

namespace app\models;

use app\core\Application;
use \PDO;

abstract class Product
{
    public const RULE_REQUIRED = 'required';
    public const RULE_UNIQUE = 'unique';
    public const RULE_INT = 'int';

    protected int $id;
    protected string $sku;
    protected string $name;
    protected string $price;



    public function __construct($sku, $name, $price) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;

    }

//    public function loadById($id) {
//        $stmt = Application::$app->db->prepare("SELECT id, name, SKU, price, attributes, type FROM products WHERE id = :id");
//        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//        $stmt->execute();
//        $result = $stmt->fetch(PDO::FETCH_ASSOC);
//        $this->id = $result['id'];
//        $this->name = $result['name'];
//        $this->sku = $result['SKU'];
//        $this->price = $result['price'];
//        $this->attributes = $result['attributes'];
//        $this->type = $result['type'];
//    }

//    public function getAllProducts() {
//        $products = array();
//
//        $stmt = Application::$app->db->query("SELECT id FROM products");
//        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            $product = new Product();
//            $product->loadById($row['id']);
//            $products[] = $product;
//        }
//
//        return $products;
//    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku($sku): string
    {
        $this->sku = $sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): string
    {
        $this->name = $name;
    }

    public function getPrice(): string
    {
        return $this->price . " $";
    }

    public function setPrice($price): string
    {
        $this->price = $price;
    }

    public function getType(): string
    {
        return $this->type . " $";
    }

    public function setType($type): string
    {
        $this->type = $type;
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

    public function save()
    {
        $query = 'INSERT INTO products(name, SKU, price) VALUES (:name, :SKU, :price)';

        $stmt = self::prepare($query);



        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':SKU', $this->sku);
        $stmt->bindValue(':price', $this->price);



        $stmt->execute();

        $this->id = Application::$app->db->lastInsertId();

        return $this->id;
    }


//    public function delete()
//    {
//        $delete = $_POST['products'];
//
//        foreach ($delete as $id)
//        {
//            $query = "DELETE FROM products WHERE id = '" . $id . "'";
//        }
//
//            $stmt = self::prepare($query);
//            $stmt->execute();
//
//        return true;
//
//        }

    public static function prepare($query)
    {
        return Application::$app->db->pdo->prepare($query);
    }



}
