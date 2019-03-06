<?php

namespace DivineOmega\LaravelExtendableBasket\Tests\Unit;

use DivineOmega\LaravelExtendableBasket\Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class MigrationsTest extends TestCase
{
    /**
     * Tests that migrations work as expected.
     */
    public function testMigrations()
    {
        $this->artisan('migrate:fresh', ['--database' => 'testbench'])->run();
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        $this->assertTrue(Schema::hasTable('baskets'));
        $this->assertTrue(Schema::hasTable('basket_items'));

        $this->assertEquals(
            ['id', 'created_at', 'updated_at'],
            Schema::getColumnListing('baskets')
        );

        $this->assertEquals(
            ['id', 'basket_id', 'basketable_id', 'basketable_type',
                'quantity', 'created_at', 'updated_at', 'meta'],
            Schema::getColumnListing('basket_items')
        );
    }

}