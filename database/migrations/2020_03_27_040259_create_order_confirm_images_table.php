<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderConfirmImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_confirm_images', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('order_confirm_id');
            $table->foreign('order_confirm_id')
                ->references('id')
                ->on('order_confirms')
                ->onDelete('cascade');

            $table->char('name', 100);
            $table->char('dimentions', 50);
            $table->char('path', 100);
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
        Schema::dropIfExists('order_confirm_images');
    }
}
