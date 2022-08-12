<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorsPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investors_packages', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('rid');
            $table->integer('investor_id');
            $table->integer('package_id');
            $table->string('code');
            $table->string('url');
            $table->string('daily_roi');
            $table->string('status')->default('pending');
            $table->float('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('fee_rate')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('last_cron_date');
            
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
        Schema::dropIfExists('packages');
    }
}
