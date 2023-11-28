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
        Schema::create('paste_access_logs', function (Blueprint $table)
        {
            $table->id();
            $table->foreignIdFor(Paste::class)->constrained();
            $table->foreignIdFor(User::class)->nullable()->constrained();

            $table->string('ip', 45);
            $table->string('user_agent');
            $table->timestamp('access_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paste_access_logs');
    }
};
