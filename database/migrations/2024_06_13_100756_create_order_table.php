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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cus_id');
            $table->foreign('cus_id')->references('c_id')->on('customer');
            $table->unsignedBigInteger('o_id');
            $table->foreign('o_id')->references('o_id')->on('owner');
            $table->decimal('grand_total', 10, 2); // Assuming grand_total is a decimal value
            $table->decimal('paidAmnt', 10, 2); // Assuming paidAmnt is a decimal value
            $table->text('pay_pic'); // Assuming picture is a text field
            $table->date('b_date'); // Assuming b_date is a date field
            $table->time('time_from'); // Assuming time_from is a time field
            $table->time('time_to'); // Assuming time_to is a time field
            $table->string('cus_req', 255)->nullable(); // Assuming cus_req is nullable
            $table->boolean('Is_Active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
