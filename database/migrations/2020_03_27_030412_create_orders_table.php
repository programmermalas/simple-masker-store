<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuid('id')->primary();
            $table->char('invoice', 100);
            $table->char('first_name', 25);
            $table->char('last_name', 25);
            $table->integer('province_id');
            $table->integer('city_id');
            $table->string('street', 150);
            $table->char('postcode', 10);
            $table->char('phone', 15);
            $table->string('email', 100);
            $table->char('resi', 50)->nullable();
            $table->enum('status', ['waited', 'payment_confirmation', 'paid', 'sended', 'delivered', 'canceled']);
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
        Schema::dropIfExists('orders');
    }
}
