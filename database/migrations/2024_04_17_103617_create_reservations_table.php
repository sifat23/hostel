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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('set null');

            $table->unsignedBigInteger('hostel_id')->nullable();
            $table->foreign('hostel_id')->references('id')
                ->on('hostels')->onDelete('set null');

            $table->string('email')->nullable();


            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')
                ->on('rooms')->onDelete('set null');

            $table->string('occupants')->nullable();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
