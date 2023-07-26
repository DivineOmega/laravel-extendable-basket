<?php

namespace DivineOmega\LaravelExtendableBasket\Tests\Models;

use DivineOmega\LaravelExtendableBasket\Interfaces\Basketable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Basketable
{
    public function getPrice($basketItemMeta = null)
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }
}
