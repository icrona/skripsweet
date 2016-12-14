<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('cake_description')->nullable()->change();
            $table->integer('cake_tier')->nullable();
            $table->integer('cake_size1')->nullable();
            $table->integer('cake_size2')->nullable();
            $table->string('cake_flavour')->nullable();
            $table->string('cake_flavour1')->nullable();
            $table->string('cake_flavour2')->nullable();
            $table->string('cake_frosting')->nullable();
            $table->string('order_from');

            $table->string('cake_image1')->nullable();
            $table->string('cake_image2')->nullable();
            $table->string('cake_image3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
