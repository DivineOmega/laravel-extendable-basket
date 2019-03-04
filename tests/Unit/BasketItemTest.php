<?php

namespace DivineOmega\LaravelExtendableBasket\Tests\Unit;

use DivineOmega\LaravelExtendableBasket\Interfaces\BasketInterface;
use DivineOmega\LaravelExtendableBasket\Tests\Models\Basket;
use DivineOmega\LaravelExtendableBasket\Tests\Models\Product;
use DivineOmega\LaravelExtendableBasket\Tests\TestCase;

class BasketItemTest extends TestCase
{
    /**
     * Test an item can be added to the basket.
     */
    public function testAddBasketItem()
    {
        $product = Product::FindOrFail(1);

        /** @var Basket $basket */
        $basket = Basket::getNew();

        $basket->add(1, $product);

        $item = $basket->items()->first();

        $this->assertEquals($product->id, $item->basketable->id);
        $this->assertEquals(1, $item->quantity);
        $this->assertEquals($product->price, $item->getPrice());

        $this->assertEquals($product->name, $item->basketable->getName());
        $this->assertEquals($product->price, $item->basketable->getPrice());

        $this->assertEquals(1, $basket->getTotalNumberOfItems());
        $this->assertEquals($product->price, $basket->getSubtotal());
    }

    /**
     * Test an item can be added to the basket with a multiple quantity set.
     */
    public function testAddBasketItemWithMultipleQuantity()
    {
        $product = Product::FindOrFail(1);

        /** @var Basket $basket */
        $basket = Basket::getNew();

        $basket->add(2, $product);

        $item = $basket->items()->first();

        $this->assertEquals($product->id, $item->basketable->id);
        $this->assertEquals(2, $item->quantity);
        $this->assertEquals($product->price * 2, $item->getPrice());

        $this->assertEquals($product->name, $item->basketable->getName());
        $this->assertEquals($product->price, $item->basketable->getPrice());

        $this->assertEquals(2, $basket->getTotalNumberOfItems());
        $this->assertEquals($product->price * 2, $basket->getSubtotal());
    }

    /**
     * Test an exception is thrown if an item with zero quantity is added.
     */
    public function testAddBasketItemWithZeroQuantity()
    {
        $this->expectException(\Exception::class);

        $product = Product::FindOrFail(1);

        /** @var Basket $basket */
        $basket = Basket::getNew();

        $basket->add(0, $product);
    }

    /**
     * Test an exception is thrown if an item with a negative quantity is added.
     */
    public function testAddBasketItemWithNegativeQuantity()
    {
        $this->expectException(\Exception::class);

        $product = Product::FindOrFail(1);

        /** @var Basket $basket */
        $basket = Basket::getNew();

        $basket->add(-1, $product);
    }

}