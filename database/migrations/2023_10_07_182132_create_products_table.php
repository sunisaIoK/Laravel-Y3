<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('Pro_Id');
            $table->string('Pro_Name');
            $table->unsignedBigInteger('Type_product_id');
            $table->foreign('Type_product_id')->references('Type_Id')->on('type_products');
            $table->unsignedBigInteger('Factory_id');
            $table->foreign('Factory_id')->references('Fac_Id')->on('factories');
            $table->dateTime('Pro_OnDate');
            $table->decimal('Pro_Price', 10, 2);
            $table->unsignedBigInteger('Unit_id');
            $table->foreign('Unit_id')->references('Un_Id')->on('units');
            $table->integer('Pro_Amount');
            $table->string('Pro_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
