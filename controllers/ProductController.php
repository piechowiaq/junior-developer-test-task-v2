<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Furniture;
use app\models\DVD;
use app\models\Book;
use app\models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $heading = "Product List";

        return $this->render('index', ['heading' => $heading]);

    }

    public function create()
    {
        $heading = "Product Add";

        return $this->render('create', ['heading' => $heading]);
    }

    public function store(Request $request)
    {
        $productType = $request->getData()['type'];

        $registry = [
            'furniture' => Furniture::class,
            'dvd' => DVD::class,
            'book' => Book::class,
        ];

        if (!array_key_exists($productType, $registry)) {
            echo 'Invalid product type';
        }

        $productClass = $registry[$productType];

        $errors = [];

        $sku = $request->getData()['sku'];

        if (!$sku){
            $errors['sku'] = 'Please, submit required data';
        }

        $name = $request->getData()['name'];

        if (!$name){
            $errors['name'] = 'Please, submit required data';
        }

        $price = $request->getData()['price'];

        if (!$price){
            $errors['price'] = 'Please, submit required data';
        }

        $attributes = $request->getData()['attributes'];

        foreach ($attributes as $key => $value) {
                if (!($value)) {
                    $errors[$key] = 'Please, submit required data';
                }
        }

        $product = new $productClass($sku, $name, $price,  $attributes);

        echo "<pre>";
        var_dump($errors);
        echo "</pre>";
        die();

        echo 'Hello from store';
    }

    public function delete()
    {

    }

}