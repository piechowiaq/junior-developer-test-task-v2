<?php

namespace app\models;

use app\core\Application;
use \PDO;

class Product
{
    protected int $id;
    protected string $sku;
    protected string $name;
    protected string $price;

    public function __construct($id, $sku, $name, $price) {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    public static function getAllProducts() {
        $db = Application::$app->db;
        $query = "SELECT p.id, p.sku, p.name, p.price, 
                    b.weight AS book_weight, 
                    d.size AS dvd_size, 
                    f.length AS furniture_length, f.width AS furniture_width, f.height AS furniture_height
                  FROM products p
                  LEFT JOIN books b ON p.id = b.id
                  LEFT JOIN dvds d ON p.id = d.id
                  LEFT JOIN furnitures f ON p.id = f.id";

        $stmt = $db->prepare($query);
        $stmt->execute();

        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $name = $row['name'];
            $sku = $row['sku'];
            $price = $row['price'];
            $product_type = '';

            if ($row['book_weight'] !== null) {
                $product_type = 'Book';
                $weight = $row['book_weight'];
                $attributes = array('weight' => $weight);
                $product = new Book($id, $sku, $name, $price, $attributes);
            } elseif ($row['dvd_size'] !== null) {
                $product_type = 'DVD';
                $size = $row['dvd_size'];
                $attributes = array('size' => $size);
                $product = new DVD($id, $sku, $name, $price, $attributes);
            } elseif ($row['furniture_length'] !== null) {
                $product_type = 'Furniture';
                $length = $row['furniture_length'];
                $width = $row['furniture_width'];
                $height = $row['furniture_height'];
                $attributes = array( 'length' => $length, 'width' => $width,  'height' => $height );
                $product = new Furniture($id, $sku, $name, $price, $attributes);
            }

            if (!empty($product_type)) {
                $product->product_type = $product_type;
                $products[] = $product;
            }
        }

        return $products;
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
