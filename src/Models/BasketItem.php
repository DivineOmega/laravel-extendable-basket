<?php
namespace DivineOmega\LaravelExtendableBasket\Models;

use Illuminate\Database\Eloquent\Model;
use DivineOmega\LaravelExtendableBasket\Interfaces\BasketItemInterface;

abstract class BasketItem extends Model implements BasketItemInterface
{
    public function basketable()
    {
        return $this->morphTo();
    }

    public function getPrice()
    {
        return $this->quantity * $this->basketable->getPrice();
    }
}