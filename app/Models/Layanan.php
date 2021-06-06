<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Opd;
use App\Models\Loket;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_layanan',
        'kode_layanan',
        'opd_id',
        'alamat',
        'no_telepon'
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function loket()
    {
        return $this->hasMany(Loket::class);
    }

    public function loketAnt()
    {
        return $this->hasMany(Loket::class)->where('loket_antrian','=', 1);
    }

    public function scopeDinas($query)
    {
        return $query->where('opd_id', auth()->user()->child_id);
    }
}
