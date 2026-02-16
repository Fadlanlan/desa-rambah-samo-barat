<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('subjek');
            $table->longText('pesan');
            $table->boolean('is_read')->default(false);
            $table->foreignId('replied_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('balasan')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();

            $table->index('is_read');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak');
    }
};
