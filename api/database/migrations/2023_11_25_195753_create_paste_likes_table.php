<?php

use App\Models\Paste;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paste_likes', function (Blueprint $table)
        {
            $table->id();
            $table->foreignIdFor(Paste::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamp('liked_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paste_likes');
    }
};
