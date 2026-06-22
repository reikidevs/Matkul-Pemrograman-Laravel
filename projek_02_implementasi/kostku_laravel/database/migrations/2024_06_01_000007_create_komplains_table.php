<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komplains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penghuni_id')->constrained('penghunis')->onDelete('cascade');
            $table->enum('kategori', ['fasilitas', 'kebersihan', 'keamanan', 'lainnya']);
            $table->string('judul', 200);
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->enum('prioritas', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komplains');
    }
};
