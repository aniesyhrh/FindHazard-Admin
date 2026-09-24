<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'score',
        'hazards_found',
        'hazards_missed',
        'completion_time',
        'performance_rating',
    ];
}
