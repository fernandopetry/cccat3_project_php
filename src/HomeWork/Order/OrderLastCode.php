<?php

declare(strict_types=1);

namespace App\HomeWork\Order;

class OrderLastCode
{
    private string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}