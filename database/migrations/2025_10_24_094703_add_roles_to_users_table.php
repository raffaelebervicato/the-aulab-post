<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->nullable()->default(false)->after('password');
            $table->boolean('is_revisor')->nullable()->default(false)->after('is_admin');
            $table->boolean('is_writer')->nullable()->default(false)->after('is_revisor');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'is_revisor', 'is_writer']);
        });
    }
};
