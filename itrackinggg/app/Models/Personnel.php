<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'working_period',
        'designation',
        'is_archived', // Include this if you want to allow mass assignment for archiving.
    ];
}
