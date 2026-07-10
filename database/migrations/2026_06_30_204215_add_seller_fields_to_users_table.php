<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Cek dulu apakah kolom 'username' sudah ada
        if (!Schema::hasColumn('users', 'username')) {
            $table->string('username')->unique()->nullable()->after('name');
        }
        
        if (!Schema::hasColumn('users', 'store_name')) {
            $table->string('store_name')->nullable()->after('email');
        }
        
        if (!Schema::hasColumn('users', 'qris_image')) {
            $table->string('qris_image')->nullable()->after('store_name');
        }
        
        if (!Schema::hasColumn('users', 'role')) {
            $table->enum('role', ['customer', 'seller', 'admin'])->default('customer')->after('qris_image');
        }
    });
}

    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $columns = ['username', 'store_name', 'qris_image', 'role'];
        foreach ($columns as $col) {
            if (Schema::hasColumn('users', $col)) {
                $table->dropColumn($col);
            }
        }
    });
}
};