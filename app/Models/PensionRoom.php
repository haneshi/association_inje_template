<?php

namespace App\Models;

use App\Traits\GlobalScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PensionRoom extends Model
{
    use HasFactory, GlobalScopes;

    protected $table = "pension_rooms";
    protected $guarded = [];

    protected $casts = [
        'amenities' => 'array'
    ];

    public function setAmenitiesAttribute($value)
    {
        $this->attributes['amenities'] = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
    public function pension(): BelongsTo
    {
        return $this->belongsTo(Pension::class, 'pension_id', 'id');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(DataFile::class, 'fileable')->orderBy('seq');
    }

    public function scopeActive($query): Builder
    {
        return $query->where('is_active', 1);
    }
}
