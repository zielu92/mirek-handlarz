<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();;
            $table->tinyInteger('photo_id')->nullable();;
            $table->text('email')->nullable();;
            $table->text('phone1')->nullable();;
            $table->text('address')->nullable();;
            $table->text('defaultCurrency');
            $table->text('otherCurrency')->nullable();
            $table->boolean('ratesOnline')->default(false);
            $table->text('defaultLanguage')->nullable();
            $table->boolean('multiLanguage')->default(true);
            $table->text('languages')->nullable();
            $table->text('adviser')->default(false);
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
        Schema::dropIfExists('options');
    }
}
