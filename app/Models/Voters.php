<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voters extends Model
{
    use HasFactory;

    protected $fillable = [
        'USN',
        'name',
        'program',
        'year',
        'school_level',
        'isVoted',
    ];
}
