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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('room_at');
            $table->unsignedInteger('user');
            $table->string('content')->max(300);
            $table->timestamp('sent_time', 0);

            $table->foreign('room_at')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
