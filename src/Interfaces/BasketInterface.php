<?php
namespace DivineOmega\LaravelExtendableBasket\Interfaces;

interface BasketInterface
{
    public static function getCurrent();
    public static function getNew();
    public function items();
    public function add(int $quantity, Basketable $basketable);
    public function getSubtotal();
    public function getTotalNumberOfItems();
    public function isEmpty();
}