<?php
namespace DivineOmega\LaravelExtendableBasket\Interfaces;

interface BasketInterface
{
    public static function getCurrent();
    public static function getNew();
    public function add(int $quantity, BasketableModel $basketable);
    public function getSubtotal();
    public function getTotalNumberOfItems();
}