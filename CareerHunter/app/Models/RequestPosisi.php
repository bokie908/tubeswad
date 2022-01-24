<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestPosisi extends Model
{
    use HasFactory;
    protected $table = "request_posisi";
    protected $fillable = [
        'user_id',
        'loker_id',
    ];
}
