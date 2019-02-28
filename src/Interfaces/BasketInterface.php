<?php
namespace DivineOmega\LaravelExtendableBasket\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface BasketInterface
{
    public static function getCurrent() : BasketInterface;
    public static function getNew() : BasketInterface;
    public function items() : HasMany;
    public function add(int $quantity, Basketable $basketable);
    public function getSubtotal();
    public function getTotalNumberOfItems() : int;
    public function isEmpty() : bool;
}