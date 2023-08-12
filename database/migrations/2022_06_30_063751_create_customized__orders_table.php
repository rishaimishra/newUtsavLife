<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizedOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customized__orders', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_user_id');
            $table->string('customer_user_id');
            $table->string('order_id');
            $table->integer('quoted_price')->nullable();
            $table->string('order_description');
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customized__orders');
    }
}
