<?php

namespace App\Models;

use App\Models\BoardPosts;
use App\Traits\GlobalScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Board extends Model
{
    use HasFactory, GlobalScopes;

    protected $table = 'boards';
    protected $guarded = [];


    public function posts(): HasMany
    {
        return $this->hasMany(BoardPosts::class);
    }
}
