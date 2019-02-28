<?php

namespace DivineOmega\LaravelExtendableBasket\Tests\Unit;

use DivineOmega\LaravelExtendableBasket\Interfaces\BasketInterface;
use DivineOmega\LaravelExtendableBasket\Tests\Models\Basket;
use DivineOmega\LaravelExtendableBasket\Tests\TestCase;

class BasketTest extends TestCase
{
    public function testCreationOfNewBasket()
    {
        /** @var Basket $basket */
        $basket = Basket::getNew();

        $this->assertTrue($basket instanceof BasketInterface);
        $this->assertDatabaseHas('baskets', $basket->getAttributes());
    }
}