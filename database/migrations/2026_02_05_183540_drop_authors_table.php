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
        Schema::dropIfExists('author_book');
        Schema::dropIfExists('authors');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
