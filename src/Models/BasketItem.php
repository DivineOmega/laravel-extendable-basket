<?php
namespace DivineOmega\LaravelExtendableBasket\Models;

use Illuminate\Database\Eloquent\Model;
use DivineOmega\LaravelExtendableBasket\Interfaces\BasketItemInterface;

abstract class BasketItem extends Model implements BasketItemInterface
{
    protected $casts = [
        'meta' => 'object',
    ];

    public function basketable()
    {
        return $this->morphTo();
    }

    public function setQuantity(int $quantity)
    {
        if ($quantity > 0) {
            $this->quantity = $quantity;
            $this->save();
        } else {
            $this->delete();
        }
    }

    public function getPrice()
    {
        return $this->quantity * $this->basketable->getPrice();
    }
}