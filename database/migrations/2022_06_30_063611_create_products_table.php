<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_user_id');
            $table->string('service_id');
            $table->string('material_name')->nullable();
            $table->string('material_desc')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_desc')->nullable();
            $table->string('count_of_product')->nullable();
            $table->string('is_available')->nullable();
            $table->integer('price')->nullable();
            $table->string('description')->nullable();
            $table->string('avg_review')->nullable();
            $table->string('total_review')->nullable();
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
        Schema::dropIfExists('products');
    }
}
