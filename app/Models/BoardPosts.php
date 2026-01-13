<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardPosts extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'board_posts';

    public function author()
    {
        return $this->morphTo();
    }
}
