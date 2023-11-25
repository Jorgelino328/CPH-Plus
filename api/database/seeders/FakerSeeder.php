<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FakerSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SyntaxHighlightSeeder::class,
            ExpirationTimeSeeder::class,
            UserSeeder::class,
            PasteSeeder::class
        ]);
    }
}
