<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = "admin";

    protected $guarded = []; // 대량할당 수정 가능
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'birth' => 'date',
    ];
}
