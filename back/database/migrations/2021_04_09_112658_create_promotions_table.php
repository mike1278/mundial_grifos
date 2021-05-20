<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name',60);
            $table->text('description');
            $table->date('start_at');
            $table->date('end_at')->nullable();
            $table->string('serial_code',150);
            $table->double('price')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('currency_id')->constrained();
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
        Schema::dropIfExists('promotions');
    }
}
