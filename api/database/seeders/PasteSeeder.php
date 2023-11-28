<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PasteSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Paste::factory(50)->create();
    }
}
