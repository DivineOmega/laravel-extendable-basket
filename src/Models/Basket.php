<?php
namespace DivineOmega\LaravelExtendableBasket\Models;

use Illuminate\Database\Eloquent\Model;
use DivineOmega\LaravelExtendableBasket\Interfaces\BasketInterface;
use Exception;

abstract class Basket extends Model implements BasketInterface
{
    const BASKET_SESSION_KEY = 'doleb_basket_id';

    public static function getCurrent()
    {
        $basket = self::find(session(BASKET_SESSION_KEY));

        if (!$basket) {
            $basket = new self;
            $basket->save();
            session()->put(self::BASKET_SESSION_KEY, $basket->id);
        }

        return $basket;
    }

    public static function getNew()
    {
        session()->forget(self::BASKET_SESSION_KEY);
        return self::getCurrent();
    }

    public function add(int $quantity, BasketableModel   $basketable)
    {
        if ($quantity < 1) {
            throw new Exception('Quantity is less than one.');
        }

        foreach($this->items as $item) {
            if ($item->basketable == $basketable) {
                $item->quantity += $quantity;
                $item->save();
                return;
            }
        }

        $item = new BasketItem;
        $item->quantity = $quantity;
        $item->basketable()->attach($basketable);
        $item->save();
    }

    public function getSubtotal()
    {
        $subtotal = 0;

        foreach ($this->items as $item) {
            $subtotal += $item->getPrice();
        }

        return $subtotal;
    }

    public function getTotalNumberOfItems()
    {
        $totalNumberOfItems = 0;

        foreach($this->items as $item) {
            $totalNumberOfItems += $item->quantity;
        }

        return $totalNumberOfItems;
    }
}