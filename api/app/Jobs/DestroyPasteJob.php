<?php
namespace App\Jobs;

use App\Models\Paste;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};

class DestroyPasteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Paste $paste
    ) {
    }

    public function handle(): void
    {
        $this->paste->delete();
    }
}
