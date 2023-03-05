<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Furniture;
use app\models\DVD;
use app\models\Book;

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


        $product = str_replace('"', '', $request->getData()['type']);



        $product = new $product('kjljlk', 'naamk', '2626', 5,5,5);

        echo "<pre>";
        var_dump($product);
        echo "</pre>";

        die();

        echo 'Hello from store';
    }

    public function delete()
    {

    }

}