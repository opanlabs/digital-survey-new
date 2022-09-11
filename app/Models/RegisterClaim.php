<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RegisterClaim extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_polis',
        'id_register_survey',
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

    protected $primaryKey = 'id_register_claim';
    protected $table = 'register_claim';

    public function register_survey()
    {   
        return $this->belongsTo(RegisterSurvey::class,'id_register_survey','id_register_survey');
    }

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
