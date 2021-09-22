<?php

declare(strict_types=1);

namespace App\Part1\Client;

use App\Part1\ValueObject\Cpf;

class Client
{
    private Cpf $cpf;

    public function __construct(Cpf $cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCpf(): Cpf
    {
        return $this->cpf;
    }

}