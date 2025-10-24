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
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('category_id')->constrained()->cascadeOnDelete();

        $table->string('title');
        $table->string('subtitle')->nullable();
        $table->string('slug')->unique();
        $table->longText('body');

        $table->string('cover_image')->nullable(); // path nello storage
        $table->unsignedSmallInteger('reading_minutes')->default(1);

        // stati: in_revisione, accettato, rifiutato
        $table->enum('status', ['in_revisione','accettato','rifiutato'])->default('in_revisione');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
