<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@test.com'
        ]);
        \App\Models\User::factory(9)->create();
    }
}
