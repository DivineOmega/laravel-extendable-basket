<?php

namespace DivineOmega\LaravelExtendableBasket\Tests\Models;

use DivineOmega\LaravelExtendableBasket\Models\BasketItem as BasketItemModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasketItem extends BasketItemModel
{
    public function basket(): BelongsTo
    {
        return $this->belongsTo(Basket::class);
    }
}