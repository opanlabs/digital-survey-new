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
        'id_user',
        'id_team',
        'address',
    ];

    public function RegisterSurvey()
    {
        return $this->hasMany(RegisterSurvey::class,'id_branch','id_branch');
    }

    public function Team()
    {
        return $this->hasMany(Team::class,'id_team','id_team');
    }

    public function User()
    {
        return $this->hasOne(User::class,'id_user','id_user');
    }
}
