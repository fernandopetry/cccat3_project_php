<?php

namespace Tests\HomeWork\Order;

use App\HomeWork\Order\Freight;
use PHPUnit\Framework\TestCase;

/**
 * Fórmula de Cálculo do Frete
 *
 * Preço do Frete = distância (km) * volume (m3) * (densidade/100)
 *
 * Exemplos de volume ocupado (cubagem)
 *
 * Camera: 20cm x 15 cm x 10 cm = 0,003 m3
 * Guitarra: 100cm x 30cm x 10cm = 0,03 m3
 * Geladeira: 200cm x 100cm x 50cm = 1 m3
 *
 * Exemplos de densidade
 *
 * Camera: 1kg / 0,003 m3 = 333kg/m3
 * Guitarra: 3kg / 0,03 m3 = 100kg/m3
 * Geladeira: 40kg / 1 m3 = 40kg/m3
 *
 * Exemplos
 *
 * distância: 1000 (fixo)
 * volume: 0,003
 * densidade: 333
 * preço: R$9,90 (1000 * 0,003 * (333/100))
 *
 * distância: 1000 (fixo)
 * volume: 0,03
 * densidade: 100
 * preço: R$30,00 (1000 * 0,03 * (100/100))
 *
 * distância: 1000 (fixo)
 * volume: 1
 * densidade: 40
 * preço: R$400,00 (1000 * 1 * (40/100))
 */
class FreightTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testCalculate(float $distance, float $volume, float $density, float $expected)
    {
        $freight = new Freight($distance, $volume, $density);
        self::assertSame($expected, $freight->calculateFreight());
    }

    public function provider(): array
    {
        /**
         * O valor de frete da camera calculado é de R$ 9.99
         * Porém, a regra de negócio tem um valor mínimo de R$ 10
         */
        return [
            'Calcula frete da camera' => [1000, 0.003, 333, 10],
            'Calcula frete da guitarra' => [1000, 0.03, 100, 30],
            'Calcula frete da geladeira' => [1000, 1, 40, 400],
        ];
    }
}
