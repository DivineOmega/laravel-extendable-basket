<?php
namespace DivineOmega\LaravelExtendableBasket\Models;

use Illuminate\Database\Eloquent\Model;
use DivineOmega\LaravelExtendableBasket\Interfaces\Basketable;

abstract class BasketableModel extends Model implements Basketable
{
    
}