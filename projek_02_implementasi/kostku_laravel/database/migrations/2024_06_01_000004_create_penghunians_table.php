<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penghunians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penghuni_id')->constrained('penghunis')->onDelete('cascade');
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->integer('durasi_kontrak')->comment('dalam bulan');
            $table->enum('status', ['active', 'expired', 'terminated'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penghunians');
    }
};
