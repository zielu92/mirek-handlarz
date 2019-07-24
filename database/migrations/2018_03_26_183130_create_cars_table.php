<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vin')->index()->nullable();
            $table->integer('model_id')->index();
            $table->integer('brand_id')->index();
            $table->decimal('bought_price', 12,2)->nullable();
            $table->char('bought_currency', 3);
            $table->decimal('sold_price', 12,2)->nullable();
            $table->char('sold_currency', 3);
            $table->string('from')->nullable();
            $table->string('offer_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->date('bought_date')->nullable();
            $table->date('in_warehouse_date')->nullable();
            $table->date('sold_date')->nullable();
            $table->date('left_warehouse_date')->nullable();
            $table->text('extra')->nullable();
            $table->integer('adviser_id')->nullable();
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
        Schema::dropIfExists('cars');
    }
}
