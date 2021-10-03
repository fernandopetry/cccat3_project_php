<?php

declare(strict_types=1);

namespace App\HomeWork\Order;

use DateTimeImmutable;

class Coupon
{
    private string $code;
    private float $discount;
    private DateTimeImmutable $expireDate;

    public function __construct(string $code, float $discount, DateTimeImmutable $expireDate)
    {
        $this->code = $code;
        $this->discount = $discount;
        $this->expireDate = $expireDate;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function isExpired(): bool
    {
        $today = new DateTimeImmutable('now');
        return $today->getTimestamp() > $this->expireDate->getTimestamp();
    }
}