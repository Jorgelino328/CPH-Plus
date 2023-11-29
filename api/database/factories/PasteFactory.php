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
            ? User::inRandomOrder()->first()?->id
            : null;

        $syntaxHighlight = $this->faker->boolean(50)
            ? SyntaxHighlight::inRandomOrder()->first()?->id
            : null;

        $content = $this->faker->paragraphs(
            $this->faker->boolean(20) ? rand(10, 50) : rand(1, 5),
            true
        );

        $password = $this->faker->boolean(10)
            ? Hash::make('password')
            : null;

        $tagList = $this->faker->boolean(20)
            ? array_map(
                fn () => $this->faker->unique()->safeColorName(),
                range(1, rand(1, 10))
            )
            : null;

        $expiration = $this->faker->boolean(20)
            ? $this->faker->dateTimeBetween('now', '+1 years')
            : null;

        $this->faker->unique(reset: true);

        return [
            'user_id'             => $user,
            'syntax_highlight_id' => $syntaxHighlight,
            'title'               => $this->faker->text(50),
            'content'             => $content,
            'tags'                => $tagList,
            'listable'            => $this->faker->boolean(90),
            'password'            => $password,
            'destroy_on_open'     => $this->faker->boolean(10),
            'expiration'          => $expiration
        ];
    }
}
