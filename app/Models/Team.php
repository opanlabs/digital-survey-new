<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Team extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_team','id_branch'
    ];

    protected $table = 'team';

    protected $primaryKey = 'id_team';

    public function Users()
    {
        return $this->hasMany(Users::class,'id_team','id_team');
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class,'id_branch','id_branch');
    }
}
