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
        $errors = [];

        if (!$request->getData()['sku']){
            $errors['sku'] = 'Please, submit required SKU.';
        }

        if (!$request->getData()['name']){
            $errors['name'] = 'Please, submit required name.';
        }

        if (!$request->getData()['price']){
            $errors['price'] = 'Please, submit required price.';
        }

        if (!$request->getData()['type']){
            $errors['type'] = 'Please, select required type.';
        }

        if (!is_numeric($request->getData()['price'])){
            $errors['price'] = 'Please, submit numeric price.';
        }

        if(!is_null($request->getData()['attributes'])) {

            foreach ($request->getData()['attributes'] as $key => $value) {
                if ($value) {
                    $errors[$key] = 'Please, submit required ' . $key . '.';
                }
            }

            foreach ($request->getData()['attributes'] as $key => $value) {
                if (!is_numeric($value)) {
                    $errors[$key] = 'Please, submit numeric ' . $key . '.';
                }
            }
        }



//        if (!array_key_exists($productType, $registry)) {
//
//            $errors['type'] = 'Please select the right product type first.';
//            $heading = "Product Add";
//
//            return $this->render('create', [
//                'heading' => $heading,
//                'errors' => $errors
//            ]);
//        }

        if (!empty($errors)){

            $heading = "Product Add";

            return $this->render('create', [
                'heading' => $heading,
                'errors' => $errors
            ]);
        }

        $productType = $request->getData()['type'];

        $registry = [
            'furniture' => Furniture::class,
            'dvd' => DVD::class,
            'book' => Book::class,
        ];

        $productClass = $registry[$productType];

        $product = new $productClass();

        assert($product instanceof Product);

        $product->loadData($request->getData());

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