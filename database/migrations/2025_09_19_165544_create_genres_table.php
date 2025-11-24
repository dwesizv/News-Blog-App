<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    function up(): void {
        Schema::create('genre', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
        });
    }

    function down(): void {
        Schema::dropIfExists('genre');
    }
};