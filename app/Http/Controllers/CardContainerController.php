<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Models\CardContainer;

class CardContainerController extends Controller
{
    public function store(){
        request()->validate([
            'name' => ['required'],
            'board_id' => ['required', 'exists:boards,id']
        ]);

        CardContainer::create([
            'board_id' => request('board_id'),
            'user_id' => auth()->id(),
            'name' => request('name')
        ]);

        redirect()->back();
    }
    public function update(CardContainer $cardContainer){
        
        request()->validate([
            'name' => ['required']
        ]);

        $cardContainer->update([
            'name' => request('name')
        ]);

        return redirect()->back();
    }

    public function delete(CardContainer $cardContainer){
        $cardContainer->delete();
        return redirect()->back();
    }
    
    // public function move(CardContainer $cardContainer){
    //     dd(request());
    //     request()->validate([
    //         'position' => ['required', 'numeric'],
    //         'board_id' => ['required']
    //     ]);

    //     $cardContainer->update([
    //         'position' => request('position'),
    //         'board_id' => request('board_id')
    //     ]);
    // }
}
