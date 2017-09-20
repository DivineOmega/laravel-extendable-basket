<?php
namespace DivineOmega\LaravelExtendableBasket\Models;

use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    public function basket()
    {
        return $this->belongsTo('DivineOmega\LaravelExtendableBasket\Models\Basket');
    }

    public function basketable()
    {
        return $this->morphTo();
    }

    public function getPrice()
    {
        return $this->quantity * $this->basketable->getPrice();
    }
}