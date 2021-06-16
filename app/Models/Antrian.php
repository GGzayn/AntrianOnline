<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Loket;
use App\Models\Layanan;
use App\Models\Opd;

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
        'tanggal_booking',
        'status_antrian',
        'jenis_antrian',
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
        return $this->antrian()->where('tanggal_antrian',date('Y-m-d'))->count();
    }
    public function getCountOfMonthAttribute()
    {
        return $this->antrian()
        ->whereMonth('created_at', Carbon::now()->month)
        ->count();
    }
}


