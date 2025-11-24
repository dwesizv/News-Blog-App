<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    function up(): void {
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->string('title', 60)->unique();
            $table->string('entry', 250);
            $table->longText('text');
            $table->string('author', 100);
            $table->foreignId('idgenre'); //$table->string('genre', 100);
            $table->string('path', 100)->nullable();
            $table->timestamps();
            $table->unique(['entry', 'author']);
            $table->foreign('idgenre')->references('id')->on('genre');
            //$table->foreign('idauthor')->references('id')->on('author');
        });
    }

    function down(): void {
        Schema::dropIfExists('blog');
    }
};