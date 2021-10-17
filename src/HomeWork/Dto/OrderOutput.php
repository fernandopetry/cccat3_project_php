<?php

declare(strict_types=1);

namespace App\HomeWork\Dto;

class OrderOutput
{
    private string $code;
    private float $total;

    public function __construct(string $code, float $total)
    {
        $this->code = $code;
        $this->total = $total;
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'total' => $this->total
        ];
    }
}