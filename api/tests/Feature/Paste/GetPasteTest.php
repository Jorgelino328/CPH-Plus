<?php
namespace Tests\Feature\Paste;

use App\Models\Paste;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class GetPasteTest extends TestCase
{
    use DatabaseTransactions;

    // SUCCESS

    public function test_get_paste_that_doesnt_have_password_without_user_and_generate_log()
    {
        $paste = Paste::factory()->create(['password' => null]);

        $this->post('/api/pastes/' . $paste->id)
            ->assertStatus(200);

        $this->assertDatabaseHas('paste_access_logs', [
            'paste_id' => $paste->id,
            'user_id'  => null
        ]);
    }

    public function test_get_paste_that_doesnt_have_password_with_user_and_generate_log()
    {
        $paste = Paste::factory()->create(['password' => null]);
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/api/pastes/' . $paste->id)
            ->assertStatus(200);

        $this->assertDatabaseHas('paste_access_logs', [
            'paste_id' => $paste->id,
            'user_id'  => $user->id
        ]);
    }

    public function test_get_paste_with_password_and_generate_log()
    {
        $paste = Paste::factory()->create(['password' => Hash::make('12345678')]);

        $this->post('/api/pastes/' . $paste->id, ['password' => '12345678'])
            ->assertStatus(200);

        $this->assertDatabaseHas('paste_access_logs', [
            'paste_id' => $paste->id,
            'user_id'  => null
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
