<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('subject', ['Matematica', 'Comunicacion', 'Ciencia', 'Quechua', 'Historia']);
            $table->enum('level', ['Primaria', 'Secundaria']);
            $table->enum('lang', ['Castellano', 'Quechua', 'Bilingue']);
            $table->enum('type', ['pdf', 'video', 'audio']);
            $table->string('file_path')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('downloads')->default(0);
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            
            $table->index(['status', 'subject']);
            $table->index(['status', 'level']);
            $table->index(['status', 'lang']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};