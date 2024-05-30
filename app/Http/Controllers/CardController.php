<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function store(){

        $colors = array("red", 
                        "yellow", 
                        "green", 
                        "blue", 
                        "indigo", 
                        "purple", 
                        "pink", 
                        "sky", 
                        "emerald", 
                        "rose", 
                        "cyan",
                        "teal",
                        "violet",
                        "fuchsia" );
        $index = array_rand($colors);
        
        request()->validate([
            'name' => ['required'],
            'board_id' => ['required', 'exists:boards,id'],
            'card_container_id' => ['required', 'exists:card_containers,id']
        ]);

        Card::create([
            'board_id' => request('board_id'),
            'card_container_id' => request('card_container_id'),
            'name' => request('name'),
            'user_id' => auth()->id(),
            'template_color' => $colors[$index]
        ]);
        return redirect()->back();
    }

    public function update(Card $card){
        request()->validate([
            'name' => ['required', 'max:255'],
            'card_id' => ['exists:cards,id']
        ]);

        $card->update([
            'name' => request('name')
        ]);
    }

    public function move(Card $card){
        
        request()->validate([
            'position' => ['required', 'numeric'],
            'card_container_id' => ['required']
        ]);

        $card->update([
            'position' => request('position'),
            'card_container_id' => request('card_container_id')
        ]);
    }

    public function delete(Card $card){
        $card->delete();
        return redirect()->back();
    }
}
