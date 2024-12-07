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
        if (!Schema::hasColumn('irs_test', 'status')) {
            Schema::table('irs_test', function (Blueprint $table) {
                $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])
                    ->default('Menunggu')
                    ->after('semester');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('irs_test', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
