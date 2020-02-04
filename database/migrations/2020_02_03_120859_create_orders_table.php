<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('name');
            $table->string('city');
            $table->string('street');
            $table->string('postal');
            $table->text('info')->nullable();
            $table->longText('project');
            $table->float('amount');
            $table->boolean('paid')->default(false);
            $table->string('payment_link', 1000)->nullable();
            $table->string('status')->default('new');
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
        Schema::dropIfExists('orders');
    }
}
