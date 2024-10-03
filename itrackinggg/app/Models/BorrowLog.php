<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'name',
        'office',
        'no',
        'date_borrowed',
        'date_returned',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
