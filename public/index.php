<?php

use App\HomeWork\Controller\GetPurchaseOrderController;
use App\HomeWork\Controller\GetPurchaseOrderListController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

if (getenv('ENVIRONMENT') != 'development') {
    $app->addErrorMiddleware(false, true, true);
}

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Bem vindo CCCAT3!");
    return $response;
});

$app->get('/purchase-order/{id}', GetPurchaseOrderController::class);
$app->get('/purchase-order', GetPurchaseOrderListController::class);

$app->run();