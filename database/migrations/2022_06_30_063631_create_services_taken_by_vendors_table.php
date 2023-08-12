<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTakenByVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_taken_by_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_user_id');
            $table->string('service_id');
            $table->string('company_name');
            $table->string('company_address');
            $table->integer('service_status');
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
        Schema::dropIfExists('services_taken_by_vendors');
    }
}
