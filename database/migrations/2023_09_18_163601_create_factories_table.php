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
        Schema::create('factories', function (Blueprint $table) {
            $table->id('Fac_Id');
            $table->string('Fac_Name');
            $table->string('Fac_Address');
            $table->string('Fac_Email')->unique();
            $table->string('Fac_Phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factories');
    }
};
