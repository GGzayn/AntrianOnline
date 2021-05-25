<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Layanan;
use App\Models\Antrian;

class Loket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_loket',
        'nama_petugas',
        'layanan_id',
        'interval_waktu',
        'interval_booking',
        'waktu_buka',
        'waktu_tutup',
        'status_loket'
    ];

    protected $casts = [
        'waktu_buka' => 'datetime:H:i',
        'waktu_tutup' => 'datetime:H:i',
    ];
    

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }

    public function scopeLayananDinas($query)
    {
        return $query->whereIn('layanan_id', auth()->user()->opd->layanan->pluck('id'));
    }

    public function getWaktuBukaNameAttribute()
    {
        return date('H:i',strtotime($this->waktu_buka));
    }  
    public function getWaktuTutupNameAttribute()
    {
        return date('H:i',strtotime($this->waktu_tutup));
    }  

    public function getStatusLoketNameAttribute($value)
    {
        return $value ? "online" : "offline";
    }  

    public function getCountOfTodayAttribute()
    {
        return $this->antrian()->where('tanggal_antrian',date('Y-m-d'))->Where('status_antrian',1)->count();
    }

    public function getStatusLoketTodayAttribute()
    {
        return $this->antrian()->where('tanggal_antrian',date('Y-m-d'))->where('status_antrian',1);
    }
}