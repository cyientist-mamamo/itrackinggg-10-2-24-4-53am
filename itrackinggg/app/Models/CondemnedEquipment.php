<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CondemnedEquipment extends Model
{
    protected $fillable = [
        'accounting_officer',
        'operating_unit_project',
        'pn_code',
        'responsible_person_id',
        'quantity',
        'unit',
        'description',
        'date_acquired',
        'fund',
        'ppe_class',
        'est_useful_life',
        'unit_price',
        'total_amount',
        'status',
    ];
    protected $table = 'condemned_equipments';
}


