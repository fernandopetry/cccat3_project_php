<?php

declare(strict_types=1);

namespace App\Part1\ValueObject;

class Cpf
{
    const CPF_SIZE = 11;
    private string $cpf;

    public function __construct(string $cpf)
    {
        $this->cpf = $this->cleanDocument($cpf);
    }

    public function validate(): bool
    {
        $cpf = $this->cpf;

        if ($this->verifySize($cpf)) {
            return false;
        }

        if ($this->verifySequentialNumbers($cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < self::CPF_SIZE; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % self::CPF_SIZE) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public function cleanDocument($cpf): string
    {
        return preg_replace('/[^0-9]/is', '', $cpf);
    }

    public function verifySize(string $cpf): bool
    {
        return strlen($cpf) != self::CPF_SIZE;
    }

    public function verifySequentialNumbers(string $cpf)
    {
        return preg_match('/(\d)\1{10}/', $cpf);
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }
}