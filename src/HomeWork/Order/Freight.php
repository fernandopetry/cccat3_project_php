<?php

declare(strict_types=1);

namespace App\HomeWork\Order;

class Freight
{
    private float $distance;
    private float $volume;
    private float $density;
    private float $minimumValue = 10;

    public function __construct(float $distance, float $volume, float $density)
    {
        $this->distance = $distance;
        $this->volume = $volume;
        $this->density = $density;
    }

    public function calculateFreight()
    {
        $calculate = $this->distance * $this->volume * ($this->density / 100);

        if ($calculate < $this->minimumValue) {
            return $this->minimumValue;
        }

        return $calculate;
    }
}