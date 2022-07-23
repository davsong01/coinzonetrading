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
            $table->string('investor_id');
            $table->string('package_id');
            $table->string('code');
            $table->string('url');
            $table->string('status')->default('pending');
            $table->float('amount');
            $table->string('currency');
            $table->string('fee_rate');
            $table->dateTime('expires_at');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
