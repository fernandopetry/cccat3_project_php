<?php

namespace Tests\Part1;

use App\Part1\CpfBefore;
use PHPUnit\Framework\TestCase;

class CpfBeforeTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testCpf($cpf, $expected)
    {
        $cpf = new CpfBefore($cpf);
        self::assertEquals($expected, $cpf->validate());
    }

    public function provider()
    {
        return [
            "String vazia" => ["", false],
            "CPF Válido" => ["23712153503", true],
            "CPF Inválido" => ["11111111111", false],
        ];
    }
}
