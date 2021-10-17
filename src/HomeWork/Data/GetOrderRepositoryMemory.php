<?php

declare(strict_types=1);

namespace App\HomeWork\Data;

use App\HomeWork\Client\Client;
use App\HomeWork\Order\Coupon;
use App\HomeWork\Order\Item;
use App\HomeWork\Order\Order;
use App\HomeWork\ValueObject\Cpf;
use DateTimeImmutable;
use Exception;

class GetOrderRepositoryMemory implements GetOrderRepositoryInterface
{

    /**
     * @throws Exception
     */
    public function getOrder(int $id): ?Order
    {
        $client = new Client(new Cpf('237.121.535-03'));
        $order = new Order($client);
        $order->addItems(new Item('Laranja', 1.10, 10)); // 11
        $order->addItems(new Item('Pera', 1.65, 3)); // 4.95
        $order->addItems(new Item('Melancia', 15.50, 1)); // 15.50
        $order->applyCoupon(new Coupon('VALE20', 0.25, new DateTimeImmutable('now')));
        $order->handler();
        return $order;
    }
}