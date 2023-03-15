<?php

namespace app\controllers;

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

        $products = Product::getAll();

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
            echo 'Invalid product type';
        }

        $productClass = $registry[$productType];

        $sku = $request->getData()['sku'];
        $name = $request->getData()['name'];
        $price = $request->getData()['price'];
        $attributes = $request->getData()['attributes'];

        $product = new $productClass($sku, $name, $price, $attributes, $productType);

        assert($product instanceof Product);

        $errors = $product->validate();

        if (!empty($errors)){

            $heading = "Product Add";

            return $this->render('create', [
                'errors' => $errors,
                'heading' => $heading
                ]);
        }

        $product->save();

        $heading = "Product Add";

        $products = Product::getAll();

        return $this->render('index', [
            'heading' => $heading,
            'products' => $products
        ]);
    }

    public function delete()
    {

        }

}