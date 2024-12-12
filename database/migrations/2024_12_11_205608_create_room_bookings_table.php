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
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            // $table->string('room_type');
            // $table->integer('room_no');
            $table->unsignedBigInteger('customer_id');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->integer('room_subtotal');
            $table->decimal('tax_amount', 8, 2);
            $table->decimal('service_fee', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_bookings');
    }
};
