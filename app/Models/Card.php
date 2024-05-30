<?php

namespace App\Models;

use App\Models\CardContainer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Card extends Model
{
    use HasFactory;

    protected $guarded = [];

    const INCREMENT_BY_1 = 3;

    public static function booted(): void{
        static::creating(function($model){
            $model->position = self::select('position')
                ->where('card_container_id', $model->card_container_id)
                ->orderByDesc('position')
                ->first()?->position + self::INCREMENT_BY_1;
        });
    }
}
