<?php

namespace app\models;

use app\core\Application;
use \PDO;

class Product
{
    protected ?int $id;
    protected string $sku;
    protected string $name;
    protected string $price;
    protected string $type;

//    public function __construct($id, $sku, $name, $price, $type) {
//        $this->id = $id;
//        $this->sku = $sku;
//        $this->name = $name;
//        $this->price = $price;
//        $this->type = $type;
//    }

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
                $product = new Book($id, $sku, $name, $price, 'book', $attributes);
            } elseif ($row['dvd_size'] !== null) {
                $product_type = 'DVD';
                $size = $row['dvd_size'];
                $attributes = array('size' => $size);
                $product = new DVD($id, $sku, $name, $price, 'dvd', $attributes);
            } elseif ($row['furniture_length'] !== null) {
                $product_type = 'Furniture';
                $length = $row['furniture_length'];
                $width = $row['furniture_width'];
                $height = $row['furniture_height'];
                $attributes = array( 'length' => $length, 'width' => $width,  'height' => $height );
                $product = new Furniture($id, $sku, $name, $price, 'furniture', $attributes);
            }

            if (!empty($product_type)) {
                $product->product_type = $product_type;
                $products[] = $product;
            }
        }



        return $products;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getSku() {
        return $this->sku;
    }

    public function setSku($sku) {
        $this->sku = $sku;
    }

    public function validate(): array
    {
        $errors = [];

        if (!$this->sku){
            $errors['sku'] = 'Please, submit required SKU.';
        }

        if (!$this->name){
            $errors['name'] = 'Please, submit required name.';
        }

        if (!$this->price){
            $errors['price'] = 'Please, submit required price.';
        }

        if (!$this->type){
            $errors['type'] = 'Please, select required type.';
        }

        if (!is_numeric($this->price)){
            $errors['price'] = 'Please, submit numeric price.';
        }

        return $errors;
    }

    public function save()
    {
        $query = 'INSERT INTO products(name, sku, price) VALUES (:name, :sku, :price)';

        $stmt = self::prepare($query);

        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':sku', $this->sku);
        $stmt->bindValue(':price', $this->price);

        $stmt->execute();

        $this->id = Application::$app->db->lastInsertId();

        return $this->id;
    }

    public function loadData($data)
    {
        foreach ($data as $key => $value) {

            if (property_exists($this, $key)) {
                $this->{$key} = $value;

            }
        }
    }


    public static function delete($ids)
    {
        foreach ($ids as $id)
        {
            $query = "DELETE FROM products WHERE id = '" . $id . "'";
        }

            $stmt = self::prepare($query);
            $stmt->execute();

        return true;

        }

    public static function prepare($query)
    {
        return Application::$app->db->pdo->prepare($query);
    }



}
