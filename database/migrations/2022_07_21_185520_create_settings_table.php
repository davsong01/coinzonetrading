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
            $table->string('page_banner')->nullable();
            $table->string('api_key')->nullable();
            $table->text('wallet_types')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_sign')->default('$');
            $table->string('callback_url')->nullable();
            $table->string('wallet_secret_key')->nullable();
            $table->string('last_archive_date')->nullable();
            $table->string('archive_dates')->nullable();
            $table->unsignedFloat('minimum_withdrawal_amount')->nullable();
            $table->unsignedFloat('maximum_withdrawal_amount')->nullable();
            $table->unsignedBigInteger('withdrawal_frequency')->nullable();

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();

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
