<?php

namespace DivineOmega\LaravelExtendableBasket\Interfaces;

interface Basketable
{
    public function getPrice($basketItemMeta = null);

    public function getName();
}
