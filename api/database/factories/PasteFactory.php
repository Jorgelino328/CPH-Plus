<?php
namespace Database\Factories;

use App\Models\{SyntaxHighlight, User};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class PasteFactory extends Factory
{
    public function definition(): array
    {
        $user = $this->faker->boolean(20)
            ? User::inRandomOrder()->first()->id
            : null;

        $syntaxHighlight = $this->faker->boolean(50)
            ? SyntaxHighlight::inRandomOrder()->first()->id
            : null;

        $content = $this->faker->paragraphs(
            $this->faker->boolean(20) ? rand(10, 50) : rand(1, 5),
            true
        );

        $password = $this->faker->boolean(10)
            ? Hash::make('password')
            : null;

        return [
            'user_id'             => $user,
            'syntax_highlight_id' => $syntaxHighlight,
            'title'               => $this->faker->text(50),
            'content'             => $content,
            'listable'            => $this->faker->boolean(90),
            'password'            => $password,
            'destroy_on_open'     => $this->faker->boolean(10),
        ];
    }
}
