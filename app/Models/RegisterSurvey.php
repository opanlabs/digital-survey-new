<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterSurvey extends Model
{
    use HasFactory;
    protected $table = 'register_survey';
    protected $primaryKey = 'id_register_survey';
    protected $fillable = [
        'register_no',
        'id_customer',
        'id_vehicle',
        'year',
        'plat_no',
        'surveyor',
        'id_user',
        'survey_date',
        'link_zoom',
        'status',
        'id_branch',
        'descriptionVehicle',
        'isStandardVehicle',
        'photoVehicle',
        'link_report_zoom',
        'type'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class,'id_user','id_user');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'id_customer','id_customer');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'id_vehicle','id_vehicle');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'id_branch','id_branch');
    }
}
