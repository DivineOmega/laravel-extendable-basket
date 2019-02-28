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

    /**
     * Ensures that retrieving the current basket correctly gets the
     * previously created basket.
     */
    public function testGettingCurrentBasket()
    {
        /** @var Basket $basket */
        $newBasket = Basket::getNew();

        /** @var Basket $basket */
        $currentBasket = Basket::getCurrent();

        $this->assertTrue($currentBasket instanceof BasketInterface);
        $this->assertDatabaseHas('baskets', $currentBasket->getAttributes());

        $this->assertEquals($newBasket->id, $currentBasket->id);
    }
}