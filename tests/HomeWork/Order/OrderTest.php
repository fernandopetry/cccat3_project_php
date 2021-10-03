<?php

namespace Tests\HomeWork\Order;

use App\HomeWork\Client\Client;
use App\HomeWork\Order\Coupon;
use App\HomeWork\Order\Item;
use App\HomeWork\Order\Order;
use App\HomeWork\ValueObject\Cpf;
use Exception;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    const CPF_VALIDO = '237.121.535-03';
    const CPF_INVALIDO = '11111111111';
    const SUM_ORDER_3_ITEMS = 31.45;

    public static function generateOrder($cpf): Order
    {
        $client = new Client(new Cpf($cpf));
        return new Order($client);
    }

    public static function generateOrder3Items($cpf): Order
    {
        $order = self::generateOrder($cpf);
        $order->addItems(new Item('Laranja', 1.10, 10)); // 11
        $order->addItems(new Item('Pera', 1.65, 3)); // 4.95
        $order->addItems(new Item('Melancia', 15.50, 1)); // 15.50
        return $order;
    }

    /**
     * @throws Exception
     */
    public function testDeveSomarItens()
    {
        $order = self::generateOrder3Items(self::CPF_VALIDO);
        $order->handler();
        self::assertSame(self::SUM_ORDER_3_ITEMS, $order->getTotalWithoutDiscount());
    }

    public function testNaoDeveFazerPedidoComCpfInvalido()
    {
        $this->expectException(Exception::class);
        $order = self::generateOrder(self::CPF_INVALIDO);
        $order->handler();
    }

    /**
     * @throws Exception
     */
    public function testDeveFazerUmPedidoCom3Itens()
    {
        $order = self::generateOrder3Items(self::CPF_VALIDO);
        self::assertTrue($order->handler());
    }

    /**
     * @throws Exception
     */
    public function testDeveriaCalcularDesconto()
    {
        $order = self::generateOrder3Items(self::CPF_VALIDO);
        $order->applyCoupon(new Coupon(1, 0.25));
        $order->handler();

        $discount = 7.8625;
        $valueLessDiscount = 23.5875;
        $sum = $discount + $valueLessDiscount;

        self::assertSame(
            $sum,
            $order->getTotalWithoutDiscount(),
            'O total do pedido sem aplicar o desconto, está incorreto.'
        );

        self::assertSame(
            $discount,
            $order->getDiscount(),
            'O valor de desconto não é o esperado.'
        );

        self::assertSame(
            $valueLessDiscount,
            $order->getTotal(),
            'O valor do (pedido - desconto) está incorreto.'
        );
    }

    /**
     * @throws Exception
     */
    public function testDeveFazerUmPedidoComCupomDeDesconto()
    {
        $order = self::generateOrder3Items(self::CPF_VALIDO);
        $order->applyCoupon(new Coupon(1, 0.1));
        $order->handler();

        $sum = $order->getTotal() + $order->getDiscount();

        self::assertSame(
            self::SUM_ORDER_3_ITEMS,
            $sum,
            'A soma do (total + desconto) não é igual ao valor do pedido.');

        self::assertNotSame(
            self::SUM_ORDER_3_ITEMS,
            $order->getTotal(),
            'O valor total é igual ao valor do pedido, deveria ter um desconto aplicado.'
        );
    }
}
