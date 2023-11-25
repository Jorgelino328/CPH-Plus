<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('syntax_highlights', function (Blueprint $table)
        {
            $table->id();
            $table->string('label', 20);
            $table->string('value', 20);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('syntax_highlights');
    }
};
