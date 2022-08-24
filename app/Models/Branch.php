<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'branch';
    protected $fillable = [
        'province_name',
    ];

    public function RegisterSurvey()
    {
        return $this->hasMany(RegisterSurvey::class,'id_branch','id_branch');
    }
}
