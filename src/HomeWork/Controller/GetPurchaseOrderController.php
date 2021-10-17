<?php

declare(strict_types=1);

namespace App\HomeWork\Controller;

use App\HomeWork\Data\GetOrderRepositoryMemory;
use App\HomeWork\Dto\OrderOutput;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

class GetPurchaseOrderController
{
    /**
     * @throws Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();

        $order = new GetOrderRepositoryMemory();
        $data = $order->getOrder(1);

        $output = new OrderOutput($data->getId(),$data->getTotal());

        $payload = json_encode($output->toArray());

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}