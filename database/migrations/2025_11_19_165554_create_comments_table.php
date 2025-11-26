<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    function up(): void {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idblog');
            $table->string('commentator', 100);
            $table->text('content');
            $table->boolean('liked')->nullable();
            $table->timestamps();
            $table->foreign('idblog')->references('id')->on('blog');
        });
    }

    function down(): void {
        Schema::dropIfExists('comment');
    }
};