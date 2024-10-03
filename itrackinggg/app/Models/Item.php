<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'category',
        'unit',
        'quantity',
        'used',
        'added',
        'expiry_date',
        'consume_type',
        'archived',
    ];
}

