<?php

declare(strict_types=1);

namespace App\HomeWork\Client;

use App\HomeWork\ValueObject\Cpf;

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