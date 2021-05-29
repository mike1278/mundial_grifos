<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name',60);
            $table->text('description');
            $table->double('discount')->unsigned();
            $table->boolean('published')->default(false);
            $table->string('serial_code',150);
            $table->double('price')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('model_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('currency_id')->constrained();
            $table->softDeletes();
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
