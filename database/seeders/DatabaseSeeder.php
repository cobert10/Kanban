<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Board;
use App\Models\CardContainer;
use App\Models\Card;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        // $board         = Board::factory()->for($user)->create();

        // $cardContainer = CardContainer::factory()->for($board)->create();

        // Card::factory(1)->for($cardContainer)->create();

        $user = User::factory()->create([
            'email' => 'cieghie10@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $board = Board::factory()->create([
            'name' => 'Project Jarvis',
            'user_id' => $user->id,
        ]);

        $cardContainer = CardContainer::factory()->create([
            'name' => 'Todo',
            'user_id' => $user->id,
            'board_id' => $board->id,
        ]);

        Card::factory(1)->create([
            'user_id' => $user->id,
            'board_id' => $board->id,
            'card_container_id' => $cardContainer->id,
            'position' => 1
        ]);
                        
    }
}
