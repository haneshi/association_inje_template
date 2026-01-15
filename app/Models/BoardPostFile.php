<?php

namespace App\Models;

use App\Traits\GlobalScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BoardPostFile extends Model
{
    use HasFactory, GlobalScopes, SoftDeletes;

    protected $guarded = [];
    protected $table = 'board_post_files';

    public function fileable()
    {
        return $this->morphTo();
    }

    protected function isImage(): Attribute
    {
        return Attribute::make(
            get: fn() => str_starts_with($this->mime_type, 'image/')
        );
    }

    public function getPreviewAttribute()
    {
        return $this->file_path ? asset('data/'.$this->file_path): null;
    }
}
