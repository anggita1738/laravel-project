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
        Schema::create('master_lowongan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dept_id')->constrained('master_departemen')->onDelete('cascade');
            $table->string('posisi');
            $table->integer('quota');
            $table->text('deskripsi');
            $table->unsignedBigInteger('user_create')->nullable();
            $table->unsignedBigInteger('user_update')->nullable();
            $table->timestamps();
            
            $table->foreign('user_create')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_update')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_lowongan');
    }
};

