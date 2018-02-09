<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditDebitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_debits', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['credit', 'debit']);
            $table->enum('form',['referral','bonus','withdrawal']);
            $table->bigInteger('transaction_id');
            $table->bigInteger('user_id');
            $table->enum('lock',['1', '0'])->default('1');
            $table->date('lock_date');
            $table->enum('status',['valid','invalid']);
            $table->bigInteger('amount');
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
        Schema::dropIfExists('credit_debits');
    }
}
