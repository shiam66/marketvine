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
            $table->string('productNumber',50);
            $table->string('productName',100);
            $table->float('sellingPrice',10,2);
            $table->string('sellingUnit',10);
            $table->float('buyingPrice',10,2)->default(0);
            $table->string('buyingUnit',10)->nullable();
            $table->float('itemsPerBuyingUnit',8,2)->default(0);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('products');
    }
}
