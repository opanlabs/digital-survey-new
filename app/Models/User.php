<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'id_branch',
        'id_team',
        'phone_number',
        'photo_url',
        'id_role',
        'password',
        'approved',
    ];

    protected $primaryKey = 'id_user';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->hasOne(Roles::class,'id_role','id_role');
    }

    public function Team()
    {
        return $this->belongsTo(Team::class,'id_team','id_team');
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class,'id_branch','id_branch');
    }

    public function RegisterSurvey()
    {
        return $this->hasMany(RegisterSurvey::class,'id_user','id_user');
    }
    
}
