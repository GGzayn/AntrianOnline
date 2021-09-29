<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Loket;
use App\Models\Layanan;
use App\Models\Opd;
use App\Models\UserDocuments;
use App\Models\NotifDocuments;
use App\Models\Districts;
use App\Models\Urbans;
use App\Models\Cities;
use App\Models\Provinces;

class Antrian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'loket_id',
        'tanggal_antrian',
        'waktu_antrian',
        'no_antrian',
        'no_telp',
        'tanggal_booking',
        'status_antrian',
        'jenis_antrian',
        'alamat',
        'rt',
        'rw',
        'urban_id',
        'district_id',
        'city_id',
        'province_id',
        'longitude',
        'latitude',
        'patokan',

    ];

    protected $casts = [
        'waktu_antrian' => 'datetime:H:i',
    ];

    protected $appends = [
        'count_of_today',
        'count_of_day',
        'count_of_month',
    ];

    public function loket()
    {
        return $this->belongsTo(Loket::class);
    }
    public function province()
    {
        return $this->belongsTo(Provinces::class);
    }
    public function city()
    {
        return $this->belongsTo(Cities::class);
    }
    public function district()
    {
        return $this->belongsTo(Districts::class);
    }
    public function urban()
    {
        return $this->belongsTo(Urbans::class);
    }

    public function userDoc()
    {
        return $this->hasMany(UserDocuments::class);
    }

    public function notifDoc()
    {
        return $this->hasMany(NotifDocuments::class);
    }


    public function getStatusAntrianNameAttribute($value)
    {
        switch($value) {
            case 1:
                return "active";
            case 2:
                return "queue";
            case 3:
                return "finish";
            default: 
                return "inactive";
            };
            
    }  
    public function getJenisAntrianNameAttribute($value)
    {
        return $value ? "offline" : "online";
    }

    public function getCountOfTodayAttribute()
    {
        return $this->where('tanggal_antrian',date('Y-m-d'))->Where('status_antrian',1)->count();
    }
    public function getCountOfDayAttribute()
    {
        return $this->where('tanggal_antrian',date('Y-m-d'))->count();
    }
    public function getCountOfMonthAttribute()
    {
        return $this
        ->whereMonth('created_at', Carbon::now()->month)
        ->count();
    }
}


