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
        Schema::create('penghunis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama', 100);
            $table->string('nik', 20)->unique();
            $table->string('no_hp', 20);
            $table->string('pekerjaan', 100)->nullable();
            $table->text('alamat_asal');
            $table->string('kontak_darurat', 100);
            $table->string('foto_ktp')->nullable();
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghunis');
    }
};
