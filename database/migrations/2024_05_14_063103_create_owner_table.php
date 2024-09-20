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
        Schema::create('owner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('o_id');
            $table->foreign('o_id')->references('id')->on('Login-details');
            $table->string('Catering_Name',255);
            $table->text('Logo',255);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('Provience',512);
            $table->string('District',255);
            $table->string('L_Muncipality',255);
            $table->string('Ward',255);
            $table->string('Pan_no',255);
            $table->text('Pan_no_photo',255);
            $table->string('Reg_no',255);
            $table->text('Reg_no_photo',255);
            $table->string('Contact',255);
            $table->string('Mobile',255);
            $table->string('Email',255);
            $table->string('Remark',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner');
    }
};
