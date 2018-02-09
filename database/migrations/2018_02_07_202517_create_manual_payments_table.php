<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManualPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->string('reference');
            $table->enum('type', ['elite_payment', 'pro_payment','pro_sub']);
            $table->bigInteger('amount');
            $table->enum('status',['approved','unapproved'])->default('unapproved');
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
        Schema::dropIfExists('manual_payments');
    }
}
