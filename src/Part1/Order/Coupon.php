<?php

declare(strict_types=1);

namespace App\Part1\Order;

class Coupon
{
    private string $code;
    private float $discount;

    public function __construct(string $code, float $discount)
    {
        $this->code = $code;
        $this->discount = $discount;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }
}