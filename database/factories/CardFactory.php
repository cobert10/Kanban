<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Board;
use App\Models\CardContainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'board_id' => Board::factory(),
            'card_container_id' => CardContainer::factory(),
            'name' => 'sprint planning',
            'description' => ''
        ];
    }
}
