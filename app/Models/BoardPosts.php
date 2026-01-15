<?php

namespace App\Models;

use App\Traits\GlobalScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BoardPosts extends Model
{
    use HasFactory, GlobalScopes, SoftDeletes;

    protected $guarded = [];
    protected $table = 'board_posts';

    public function author()
    {
        return $this->morphTo();
    }

    public function getPreviewAttribute()
    {
        return $this->image ? asset('data/' . $this->image) : asset('assets/img/bg/no-image.jpg');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(BoardPostFile::class, 'fileable')->orderBy('seq');
    }

    public function scopeFullTextSearch($query, $term)
    {
        $termLength = mb_strlen($term);
        // 1글자 또는 2글자 검색어 → LIKE절 사용
        if ($termLength <= 2) {
            return $query->where(function ($q) use ($term) {
                $q->where('title', 'LIKE', "%{$term}%")
                    ->orWhere('content', 'LIKE', "%{$term}%")
                    ->orWhere('content_sub', 'LIKE', "%{$term}%");
            });
        }

        // 3글자 이상 → Full-Text Search 사용 (성능 좋음)
        return $query->whereRaw(
            "MATCH(title, content, content_sub) AGAINST(? IN BOOLEAN MODE)",
            [$term . '*']
        );
    }
}
