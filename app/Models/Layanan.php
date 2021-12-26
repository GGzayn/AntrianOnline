<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Opd;
use App\Models\Loket;
use App\Models\SyaratLayanan;

use Carbon\Carbon;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_layanan',
        'kode_layanan',
        'opd_id',
        'alamat',
        'no_telepon',
        'jenis_layanan',
        'kata_kunci'
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function syaratLayanan()
    {
        return $this->hasOne(SyaratLayanan::class);
    }

    public function loket()
    {
        return $this->hasMany(Loket::class);
    }

    public function loketAnt()
    {
        return $this->hasMany(Loket::class)->where('loket_antrian','=', 1);
    }
    public function loketOff()
    {
        return $this->hasMany(Loket::class)->where('loket_antrian','=', 2);
    }

    public function scopeDinas($query)
    {
        return $query->where('opd_id', auth()->user()->child_id);
    }
}
