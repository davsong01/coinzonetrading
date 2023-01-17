<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->string('investor_id');
            $table->float('amount');
            $table->string('instrument');
            $table->dateTime('approved_date')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('trade_id')->nullable();
            $table->float('profit')->nullable();
            $table->string('status')->nullable(); // Initiated, pending, in progress, closed

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
        Schema::dropIfExists('trades');
    }
}
