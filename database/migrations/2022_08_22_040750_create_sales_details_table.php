<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->string('invoice');
            $table->date('invoiceDate');
            $table->integer('customerId');
            $table->integer('itemId');
            $table->float('qty');
            $table->string('unit');
            $table->float('unitPrice');
            $table->float('discountPer',10,2)->nullable();
            $table->float('amount',10,2);
            $table->tinyInteger('createdBy')->default(0);
            $table->tinyInteger('updatedBy')->default(0);
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
        Schema::dropIfExists('sales_details');
    }
}
