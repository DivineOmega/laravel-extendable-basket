<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddMetaToBasketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $dbType = DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);

        Schema::table('basket_items', function (Blueprint $table) use ($dbType) {
            $field = $table->text('meta');
            if ($dbType === 'sqlite') {
                $field->default('[]');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basket_items', function (Blueprint $table) {
            $table->dropColumn('meta');
        });
    }
}
