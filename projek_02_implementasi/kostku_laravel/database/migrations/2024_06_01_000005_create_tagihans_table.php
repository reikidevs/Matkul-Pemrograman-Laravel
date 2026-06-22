<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penghunian_id')->constrained('penghunians')->onDelete('cascade');
            $table->string('periode', 20)->comment('format: YYYY-MM');
            $table->decimal('jumlah', 10, 2);
            $table->date('tanggal_jatuh_tempo');
            $table->decimal('denda', 10, 2)->default(0);
            $table->enum('status', ['unpaid', 'pending', 'paid'])->default('unpaid');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
