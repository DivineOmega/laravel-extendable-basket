# Laravel Extendable Basket

The Laravel Extendable basket library provides several abstract classes that implement basic ecommerce basket functionality.
These classes must be extended by your application.

## Installation

Just install the latest version using composer.

```
composer require divineomega/laravel-extendable-basket
```

## Setup

You need to perform various setup steps in order to make use of this package.

### Database tables

Two database tables are required to store basket and basket item data. By default these are called `Baskets` and `BasketItems`. This package provide database migrations to create these tables.

Running the following command will move the package's migrations into your `database/migrations` directory.

```
php artisan vendor:publish --provider="DivineOmega\LaravelExtendableBasket\Providers\LaravelExtendableBasketServiceProvider" --force
```

If you wish to change the table names, you can modify the migrations. When you're happy, just run the migrations.

```
php artisan migrate
```

### Models

Now you need to create two related models, one to hold basket details and one to hold basket items details. Two example models are shown below. They can be modified or added to as necessary.

Create a Basket model.

```php
# app/Basket.php

<?php
namespace App;

use DivineOmega\LaravelExtendableBasket\Models\Basket as BasketModel;

class Basket extends BasketModel
{
    public function items()
    {
        return $this->hasMany('App\BasketItem');
    }
}
```

Create a BasketItem model.

```php
# app/BasketItem.php

<?php
namespace App;

use DivineOmega\LaravelExtendableBasket\Models\BasketItem as BasketItemModel;

class BasketItem extends BasketItemModel
{
    public function basket()
    {
        return $this->belongsTo('App\Basket');
    }
}
```

### Basketable model

Anything that be placed in the basket provided by this library is considered
'basketable'. You can make any existing Eloquent model basketable, simple by
making it extend the `Basketable` class, rather than `Model`.

For example, if you had a `Product` model, you can change it as follows.

```php
# app/Product.php

<?php
namespace App;

use DivineOmega\LaravelExtendableBasket\Models\BasketableModel;

class Product extends BasketableModel {

    // ...

}
```

Note that any basketable models must have a `getPrice()` and a `getName()` method
that returns a numeric price and textual name of the basketable, respectively.

## Usage

This section describes the use of the basket and basket item functionality 
provided by this package. It assumes you have performed the required installation
and setup, in the manner specified above.

Remember to `use` the basket and/or basket item models you have created, where
necessary.

### Getting the current basket

From anywhere in your application, you can get the current basket. If no basket 
currently exists in the session, one will be created.

```php
$basket = Basket::getCurrent();
```

### Add item(s) to the basket

After getting the current basket, you can easily add items to it using the basket's
`add` method. You need to provide it with a quantity and any basketable model.

```php
$quantity = 5;
$product = Product::FindOrFail(1);

$basket->add($quantity, $product);
```

### Getting basket items

Getting items from the basket and the basketable model they contain can be easily 
done. See the example below.

```php
foreach($basket->items as $item) {
    $product = $item->basketable;
    echo $product->name;
}
```

## Changing the quantity of a basket item

Each basket item has a quantity associated with it. It is set when and item is
added to the basket, but can be modified later via the `setQuantity` method.

```php
$item = $basket->items->first();
$item->setQuantity($request->quantity);
```

## Removing a basket item

Basket items can easily be removed simply by deleting them. See the following 
example.

```php
$item = $basket->items->first();
$item->delete();
```

## Getting the unit cost of a basket item

Getting the unit cost of a basket item just involves calling the `getPrice` method of
the basketable model associated with the baske item. See the example below.

```php
$item = $basket->items->first();
$item->basketable->getPrice();
```

## Getting the line total of a basket item

The basket item class provides a `getPrice` method gets the line total. This is simply
the basketable's price multiplied by the basket item quantity. The example code below
shows how to use this method.

```php
$item = $basket->items->first();
$item->getPrice();
```

## Getting the basket subtotal

A `getSubtotal` method is provided in the basket class that provides the total of all
items in the basket. See the following example.

```php
$subtotal = $basket->getSubtotal()
```

If you wish to add delivery costs or discounts, you can create a new `getTotal` method
in your basket class. This method can call the `getSubtotal` method, and then modify
and return it, in whatever way you wish.

An example Basket class implementing this idea is shown below.

```php
# app/Basket.php

<?php
namespace App;

use DivineOmega\LaravelExtendableBasket\Models\Basket as BasketModel;

class Basket extends BasketModel
{
    public function items()
    {
        return $this->hasMany('App\BasketItem');
    }

    public function getTotal()
    {
        $deliveryCost = 3.99;

        return $this->getSubtotal() + $deliveryCost;
    }
}
```