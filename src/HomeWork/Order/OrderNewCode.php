<?php

declare(strict_types=1);

namespace App\HomeWork\Order;

use DateTimeImmutable;

class OrderNewCode
{
    private OrderLastCode $lastCode;
    private DateTimeImmutable $now;

    public function __construct(OrderLastCode $lastCode, DateTimeImmutable $now)
    {
        $this->lastCode = $lastCode;
        $this->now = $now;
    }

    public function getCode(): string
    {
        $yearNow = (int)$this->now->format('Y');
        $lastYear = (int)substr($this->lastCode->getCode(), 0, 4);
        $codeBefore = (int)substr($this->lastCode->getCode(), 4);
        $codeBefore++;
        if ($yearNow > $lastYear) {
            $codeBefore = 1;
        }
        return $yearNow . $codeBefore;
    }
}