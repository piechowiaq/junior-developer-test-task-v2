<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Furniture;
use app\models\DVD;
use app\models\Book;
use app\models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $heading = "Product List";
        $products = Product::getAllProducts();

        return $this->render('index', [
            'heading' => $heading,
            'products' => $products
        ]);

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

        $errors = array();
        if (!array_key_exists($productType, $registry)) {

            $errors['type'] = 'Please select the right product.';

            $errors_json = json_encode($errors);

            header('Location: addproduct?errors=' . urlencode($errors_json));

            exit;
        }

        $productClass = $registry[$productType];

        $sku = $request->getData()['sku'];
        $name = $request->getData()['name'];
        $price = $request->getData()['price'];
        $type = $request->getData()['type'];
        $attributes = $request->getData()['attributes'];

        $product = new $productClass(null, $sku, $name, $price, $type, $attributes);

        assert($product instanceof Product);

        $errors = $product->validate();

        if (!empty($errors)){

            $errors_json = json_encode($errors);

            header('Location: addproduct?errors=' . urlencode($errors_json));

            exit;
        }

        $product->save();

        $heading = "Product Add";
        $products = Product::getAllProducts();

        return $this->render('index', [
            'heading' => $heading,
            'products' => $products
        ]);
    }

    public function delete(Request $request)
    {
        Product::delete($_POST['products']);

        $heading = "Product Add";
        $products = Product::getAllProducts();

        return $this->render('index', [
            'heading' => $heading,
            'products' => $products
        ]);
    }

}