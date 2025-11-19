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
        Schema::create('transaksi_pendaftar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lowongan')->constrained('master_lowongan')->onDelete('cascade');
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->text('address');
            $table->string('no_telp');
            $table->string('university');
            $table->string('major');
            $table->decimal('ipk', 3, 2);
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->string('path_cv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pendaftar');
    }
};

