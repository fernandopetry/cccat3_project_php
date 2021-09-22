<?php

declare(strict_types=1);

namespace App\Part1\Order;

class Item
{
    private string $description;
    private float $price;
    private int $quantity;

    public function __construct(string $description, float $price, int $quantity)
    {
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}