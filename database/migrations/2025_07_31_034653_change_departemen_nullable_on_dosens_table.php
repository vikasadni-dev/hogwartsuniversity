<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->string('departemen', 50)->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->string('departemen', 50)->nullable()->change();
        });
    }
};

