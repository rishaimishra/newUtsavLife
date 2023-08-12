<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_user_id');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('vendor_user_id');
            $table->string('services');
            $table->integer('discount');
            $table->integer('total_price');
            $table->string('event_date');
            $table->string('event_city');
            $table->string('event_address');
            $table->string('event_pin');
            $table->string('txn_no');
            $table->boolean('is_customized');
            $table->integer('order_status');
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
        Schema::dropIfExists('orders');
    }
}
