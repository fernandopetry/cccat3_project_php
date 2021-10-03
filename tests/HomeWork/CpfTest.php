<?php

namespace Tests\HomeWork;

use App\HomeWork\ValueObject\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testCpf($cpf, $expected)
    {
        $cpf = new Cpf($cpf);
        self::assertEquals($expected, $cpf->validate());
    }

    public function provider(): array
    {
        return [
            "String Vazia" => ["", false],
            "String Parcial" => ["23712", false],
            "CPF Válido Sem o Digito" => ["237121535", false],
            "CPF Válido Formatado" => ["237.121.535-03", true],
            "CPF Válido Primeiro" => ["111.444.777-35", true],
            "CPF Válido" => ["23712153503", true],
            "CPF Válido Inteiro" => [23712153503, true],
            "CPF Inválido" => ["11111111111", false],
        ];
    }
}
