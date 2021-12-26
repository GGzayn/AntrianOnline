<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Layanan;
use App\Models\User;

class Opd extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_opd',
        'nama_opd',
        'nama_kordinator',
        'nip_kordinator',
        'jabatan',
        'is_active'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];


    public function layanan()
    {
        return $this->hasMany(Layanan::class);
    }

    public function getIsActiveNameAttribute($value)
    {
        return $value ? "active" : "inactive";
    }  
}
