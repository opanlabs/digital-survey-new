<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'id_customer';
    protected $fillable = [
        'customer_name',
        'phone_number',
        'email',
    ];

    public function RegisterSurvey()
    {
        return $this->hasMany(RegisterSurvey::class,'id_customer','id_customer');
    }
}
