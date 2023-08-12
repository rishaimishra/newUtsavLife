<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPerchaseHistoryTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__perchase__history_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('customer_user_id');
            $table->string('order_details_id');
            $table->time('purchase_date_time'); 
            $table->string('transaction_status_id');
            $table->string('trsansaction_id');
            $table->string('reference_id');
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
        Schema::dropIfExists('user__perchase__history_transactions');
    }
}
