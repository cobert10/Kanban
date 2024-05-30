<?php

namespace App\Models;

use App\Models\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CardContainer extends Model
{
    use HasFactory;

    protected $guarded = [];

    const INCREMENT_BY_3 = 3;

    public function cards():HasMany{
        return $this->hasMany(Card::class);
    }

    public function board():BelongsTo{
        return $this->belongsTo(Board::class);
    }
    // public static function booted(): void{
    //     static::creating(function($model){
    //         $model->position = self::select('position')
    //             ->where('board_id', $model->board_id)
    //             ->orderByDesc('position')
    //             ->first()?->position + self::INCREMENT_BY_3;
    //     });
    // }
}
