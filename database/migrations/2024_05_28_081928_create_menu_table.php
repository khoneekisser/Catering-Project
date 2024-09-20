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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('b_id');
            $table->foreign('b_id')->references('o_id')->on('owner');
            $table->string('item_name',255);
            $table->string('category',255);
            $table->text('picture',255);
            $table->string('price',255);
            $table->boolean('available')->default(true); 
            $table->boolean('status')->default(true); 
            $table->string('description',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
