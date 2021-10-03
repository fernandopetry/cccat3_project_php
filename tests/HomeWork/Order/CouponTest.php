<?php

namespace Tests\HomeWork\Order;

use App\HomeWork\Order\Coupon;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class CouponTest extends TestCase
{
    public function testDeveEstarExpiradoCupom()
    {
        $coupon = new Coupon(1, 0.1, new DateTimeImmutable('2021-10-01'));
        self::assertTrue($coupon->isExpired());
    }

    public function testDeveEstarValidoCupom()
    {
        $nowAfterOneMinute = new DateTimeImmutable('now');
        $nowAfterOneMinute->add(new DateInterval('PT1M'));

        $coupon = new Coupon(1, 0.1, $nowAfterOneMinute);
        self::assertFalse($coupon->isExpired());
    }
}
