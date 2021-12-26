<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cities;
use App\Models\Urbans;
use App\Models\Loket;
use App\Models\Antrian;
use App\Models\Upt;

class Districts extends Model
{
    use HasFactory;

    protected $fillable = [
        'district',
        'city_id',
        'upt_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];
    public function upt()
    {
        return $this->belongsTo(Upt::class);
    }

    public function city()
    {
        return $this->belongsTo(Cities::class);
    }
    public function urban()
    {
        return $this->hasMany(Urbans::class,'district_id','id');
    }

    public function loket()
    {
        return $this->hasMany(Loket::class);
    }
    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }
}
