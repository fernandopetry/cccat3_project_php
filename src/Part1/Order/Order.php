<?php

declare(strict_types=1);

namespace App\Part1\Order;

use App\Part1\Client\Client;
use Exception;

class Order
{
    /** @var Item[] */
    private array $items;
    private Coupon $coupon;
    private Client $client;

    private float $totalWithoutDiscount = 0;
    private float $total = 0;
    private float $discount = 0;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function addItems(Item $items): void
    {
        $this->items[] = $items;
    }

    public function applyCoupon(Coupon $coupon): void
    {
        $this->coupon = $coupon;
    }

    private function processItems(): void
    {
        foreach ($this->items as $item) {
            $this->totalWithoutDiscount += $item->getQuantity() * $item->getPrice();
        }
    }

    private function calculateDiscount(): void
    {
        if (!isset($this->coupon)) {
            return;
        }
        $this->discount = $this->totalWithoutDiscount * $this->coupon->getDiscount();
    }

    private function calculateTotal()
    {
        $this->total = $this->totalWithoutDiscount - $this->discount;
    }

    public function getTotalWithoutDiscount(): float
    {
        return $this->totalWithoutDiscount;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @throws Exception
     */
    public function handler()
    {
        if (!$this->client->getCpf()->validate()) {
            throw new Exception('CPF Inválido');
        }

        $this->processItems();
        $this->calculateDiscount();
        $this->calculateTotal();

        if (count($this->items) === 3) {
            return true;
        }

        return false;
    }
}