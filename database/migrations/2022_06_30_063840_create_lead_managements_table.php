<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_managements', function (Blueprint $table) {
            $table->id();
            $table->string('lead_name');
            $table->string('lead_email');
            $table->string('lead_phone')->nullable();
            $table->string('category_id')->nullable();
            $table->string('services')->nullable();
            $table->string('lead_city')->nullable();
            $table->string('lead_address')->nullable();
            $table->string('lead_pin')->nullable();
            $table->string('agent_id')->nullable();
            $table->integer('lead_status')->nullable();
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
        Schema::dropIfExists('lead_managements');
    }
}
