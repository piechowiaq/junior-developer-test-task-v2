<?php

use app\controllers\ProductController;
use app\core\Application;

require_once __DIR__.'/../vendor/autoload.php';
$config = require __DIR__.'/../config.php';


$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [ProductController::class, 'index']);
$app->router->get('/addproduct', [ProductController::class, 'create']);
$app->router->post('/storeproduct', [ProductController::class, 'store']);
$app->router->post('/delete-products', [ProductController::class, 'delete']);

$app->run();