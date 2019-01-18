<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->bigInteger('id')->unsigned();
            $table->primary('id');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('first_invoice')->nullable();
            $table->string('url')->nullable();
            $table->integer('price')->nullable();
            $table->integer('amount')->nullable();
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
        Schema::dropIfExists('products');
    }
}
