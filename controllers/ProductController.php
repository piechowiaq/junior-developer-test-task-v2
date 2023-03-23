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

        if (!array_key_exists($productType, $registry)) {

            $errors['type'] = 'Please select the right product type first.';
            $heading = "Product Add";

            return $this->render('create', [
                'heading' => $heading,
                'errors' => $errors
            ]);
        }

        $productClass = $registry[$productType];

        $product = new $productClass();

        assert($product instanceof Product);

        $product->loadData($request->getData());

        $errors = $product->validate();

        if (!empty($errors)){

            $heading = "Product Add";

            return $this->render('create', [
                'heading' => $heading,
                'errors' => $errors
            ]);
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