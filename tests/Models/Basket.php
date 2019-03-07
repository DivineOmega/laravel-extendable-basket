<?php

namespace DivineOmega\LaravelExtendableBasket\Tests\Models;

use DivineOmega\LaravelExtendableBasket\Models\Basket as BasketModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Basket extends BasketModel
{
    public function items(): HasMany
    {
        return $this->hasMany(BasketItem::class);
    }
}
