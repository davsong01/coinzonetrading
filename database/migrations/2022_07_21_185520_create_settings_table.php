<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('light_logo')->default('front-end/images/logo-light.png');
            $table->string('dark_logo')->default('front-end/images/logo-dark.png');
            $table->string('favicon')->default('front-end/images/favicon.png');
            $table->string('official_email')->nullable();
            $table->string('wallet_address')->nullable();
            $table->string('callback_url')->nullable();
            $table->string('wallet_secret_key')->nullable();
            $table->string('last_archive_date')->nullable();
            $table->string('archive_dates')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
