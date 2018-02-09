<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpgradesettingssMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_upgrade_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_subscription_id');
            $table->integer('to_subscription_id');
            $table->integer('upgrade_fee');
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
        Schema::dropIfExists('subscription_upgrade_settings');
    }
}
