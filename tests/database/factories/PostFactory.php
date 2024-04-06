<?php

namespace Foxws\WireUse\Tests\Database\Factories;

use Foxws\WireUse\Tests\Models\Post;
use Foxws\WireUse\Tests\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'published_at' => now(),
        ];
    }
}
