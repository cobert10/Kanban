<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Board;
use App\Models\CardContainer;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(){
        return Inertia::render('Boards/Index', [
            'boards' => auth()->user()->boards
        ]);
    }

    public function show(Board $board){
        $board->load(['card_containers.cards' => fn($query) => $query->orderBy('position')]);
        return Inertia::render('Boards/Board/Show', [
            'board' => $board
        ]);
    }

    public function store(){
        $titles = Array('Todo', 'Completed');

        request()->validate([
            'name' => 'required'
        ]);

        $board = Board::create([
            'user_id' => auth()->id(),
            'name' => request('name')
        ]);

        // Automatically create todo and completed containers when creating a new board
        foreach($titles as $title){
            CardContainer::create([
                'board_id' => $board['id'],
                'user_id' => auth()->id(),
                'name' => $title
            ]);
        }

        return redirect()->intended(route('boards.show', $board));
    }

    public function update(Board $board){

        request()->validate([
            'name' => ['required', 'max:255']
        ]);

        $board->update(['name' => request('name')]);
        

        return redirect()->back();
    }


}
