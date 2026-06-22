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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar', 10)->unique();
            $table->enum('tipe', ['standar', 'deluxe', 'vip']);
            $table->decimal('luas', 5, 2);
            $table->decimal('harga_sewa', 10, 2);
            $table->text('fasilitas')->nullable();
            $table->integer('lantai')->default(1);
            $table->enum('status', ['tersedia', 'terisi', 'maintenance'])->default('tersedia');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
