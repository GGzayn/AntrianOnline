<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Provinces;
use App\Models\Districts;
use App\Models\Antrian;

class Cities extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'province_id',
    ];

    public function province()
    {
        return $this->belongsTo(Provinces::class);
    }

    public function district()
    {
        return $this->hasMany(Districts::class);
    }
    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }
}
