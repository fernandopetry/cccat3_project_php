<?php

namespace Tests\HomeWork\Order;

use App\HomeWork\Order\OrderLastCode;
use App\HomeWork\Order\OrderNewCode;
use DateTimeImmutable;
use Exception;
use PHPUnit\Framework\TestCase;

class OrderNewCodeTest extends TestCase
{

    /**
     * @dataProvider provider
     * @throws Exception
     */
    public function testDeveGerarUmCodigoDePedido($expected,$lastCode,$now)
    {
        $lastCode = new OrderLastCode($lastCode);
        $newCode = new OrderNewCode($lastCode, new DateTimeImmutable($now));
        self::assertSame($expected, $newCode->getCode());
    }

    public function provider(): array
    {
        return [
            'Com o código anterior no mesmo ano' => ['20212','20211','2021-10-10'],
            'Com o código anterior em ano anterior' => ['20211','20205','2021-10-10'],
        ];
    }
}
