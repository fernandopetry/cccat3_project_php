<?php

declare(strict_types=1);

namespace App\HomeWork\Controller;

use App\HomeWork\Data\GetOrderRepositoryMemory;
use App\HomeWork\Dto\OrderOutput;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

class GetPurchaseOrderListController
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $payload = [];
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        //

        for($i=0;$i<5;$i++) {
            $order = new GetOrderRepositoryMemory();
            $data = $order->getOrder(1);

            $output = new OrderOutput($data->getId(), $data->getTotal());

            $payload[] = $output->toArray();
        }

        $payload = json_encode($payload);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}