<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'equipments';

    // Add fillable properties
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
        'is_archived',
    ];
    public function responsiblePerson()
{
    return $this->belongsTo(Personnel::class, 'responsible_person_id');
}

}
