<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Board extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function card_containers():HasMany{
        return $this->hasMany(CardContainer::class);
    }
}
