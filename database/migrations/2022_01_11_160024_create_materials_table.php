<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('country_id');
            $table->string('quantity')->nullable();
            $table->bigInteger('price')->nullable();
            $table->foreignId('user_id');
            $table->string('state');
            $table->string('image')->nullable();
            $table->string('address');;
            $table->string('city');
            $table->text('additional')->nullable();
            $table->string('status')->nullable();
            $table->uuid('reference')->nullable();
            $table->bigInteger('views')->nullable();
            $table->foreignId('currency_id');
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
        Schema::dropIfExists('materials');
    }
}
