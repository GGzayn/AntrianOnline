<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Opd;
use App\Models\Districts;
use App\Models\Urbans;
use App\Models\Upt;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function opd()
    {
        
        return $this->belongsTo(Opd::class,'child_id','id');
    }
    public function upt()
    {
        
        return $this->belongsTo(Upt::class,'child_id','id');
    }
    public function district()
    {
        return $this->belongsTo(Districts::class,'child_id','id');
    }
    public function urban()
    {
        
        return $this->belongsTo(Urbans::class,'child_id','id');
    }

    public function scopeDinas()
    {
        return $this->where('child_id',auth()->user()->child_id);
    }
    
}
