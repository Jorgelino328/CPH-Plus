<?php
namespace Tests\Feature\Paste;

use App\Models\Paste;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class GetPasteTest extends TestCase
{
    use DatabaseTransactions;

    // SUCCESS

    public function test_get_paste_that_doesnt_have_password()
    {
        $paste = Paste::factory()->create(['password' => null]);

        $this->post('/api/pastes/' . $paste->id)
            ->assertStatus(200);

        $this->assertDatabaseHas('paste_access_logs', [
            'paste_id' => $paste->id
        ]);
    }

    public function test_get_paste_with_password()
    {
        $paste = Paste::factory()->create(['password' => Hash::make('12345678')]);

        $this->post('/api/pastes/' . $paste->id, ['password' => '12345678'])
            ->assertStatus(200);

        $this->assertDatabaseHas('paste_access_logs', [
            'paste_id' => $paste->id
        ]);
    }

    // ERROR

    public function test_get_unexisting_paste()
    {
        $this->post('/api/pastes/' . PHP_INT_MAX)
            ->assertStatus(404);
    }

    public function test_get_paste_with_invalid_password()
    {
        $paste = Paste::factory()->create(['password' => Hash::make('12345678')]);

        $this->post('/api/pastes/' . $paste->id, [ 'password' => 'wrong'])
            ->assertStatus(401);
    }
}
