<?php

declare(strict_types=1);

namespace App\HomeWork\Data;

use App\HomeWork\Order\Order;

interface GetOrderRepositoryInterface
{
    public function getOrder(int $id): ?Order;
}