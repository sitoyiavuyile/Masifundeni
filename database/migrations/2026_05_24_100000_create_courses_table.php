<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
        $table->id();

        $table->foreignId('instructor_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->string('code')->unique();
        $table->string('title');
        $table->text('description')->nullable();

        $table->integer('credits')->default(0);

        $table->enum('status', ['draft', 'published', 'archived'])
            ->default('draft');

        $table->string('slug')->unique();

        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
