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
            $table->id();
            $table->date('created_at');
            $table->timestamp('updated_at');
            $table->string('order_unique_id');
            $table->integer('amount');
            $table->string('order_product_ids');
            $table->integer('user_id');
            $table->string('shipment_track_id')->nullable();
            $table->integer('shipment_company_id');
            $table->enum('order_status',['Yeni Sipariş','Hazırlanıyor','Kargolandı','Tamamlandı','İade'])->default('Yeni Sipariş');


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
