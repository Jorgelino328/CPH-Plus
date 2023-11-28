<?php
namespace Tests\Feature\Paste;

use App\Models\{Paste, User};
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreatePasteTest extends TestCase
{
    use DatabaseTransactions;

    private array $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->data = Paste::factory()->make(['tags' => null])->toArray();
    }

    // SUCCESS

    public function test_create_paste_anonymously(): void
    {
        $this->post('/api/pastes', $this->data)
            ->assertStatus(201);

        $this->assertDatabaseHas('pastes', [
            'title'     => $this->data['title'],
            'user_id'   => null
        ]);
    }

    public function test_create_paste_as_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/api/pastes', $this->data)
            ->assertStatus(201);

        $this->assertDatabaseHas('pastes', [
            'title'     => $this->data['title'],
            'user_id'   => $user->id
        ]);
    }

    // ERROR

    public function test_create_paste_with_unexisting_syntax_highlight(): void
    {
        $this->data['syntax_highlight_id'] = 999;

        $this->post('/api/pastes', $this->data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('syntax_highlight_id');
    }

    public function test_create_paste_with_invalids_expiration(): void
    {
        foreach ([-1, 599, 31536001, 999999999] as $seconds)
        {
            $this->data['seconds_to_expire'] = $seconds;

            $this->post('/api/pastes', $this->data)
                ->assertStatus(422)
                ->assertJsonValidationErrorFor('seconds_to_expire');
        }
    }

    public function test_create_paste_without_title(): void
    {
        $this->data['title'] = "";

        $this->post('/api/pastes', $this->data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('title');
    }

    public function test_create_paste_with_longer_than_max_title_size(): void
    {
        $this->data['title'] = str_repeat('a', 51);

        $this->post('/api/pastes', $this->data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('title');
    }

    public function test_create_paste_with_repeated_tags(): void
    {
        $this->data['tags'] = ['abc', 'abc'];

        $this->post('/api/pastes', $this->data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('tags.0');
    }

    public function test_create_paste_with_more_than_max_tags(): void
    {
        $this->data['tags'] = range('a', 'z');

        $this->post('/api/pastes', $this->data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('tags');
    }

    public function test_create_paste_with_long_than_max_tag_size(): void
    {
        $this->data['tags'] = [str_repeat('a', 26)];

        $this->post('/api/pastes', $this->data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('tags.0');
    }

    public function test_create_paste_with_long_than_max_content_size(): void
    {
        $this->data['content'] = str_repeat('a', 500001);

        $this->post('/api/pastes', $this->data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('content');
    }

    public function test_create_paste_with_shorter_than_min_password_length(): void
    {
        $this->data['password'] = "1234567";

        $this->post('/api/pastes', $this->data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('password');
    }
}
