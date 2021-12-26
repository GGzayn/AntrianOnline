<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Districts;
use App\Models\Loket;

class Upt extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_upt',
        'upt',
        'alamat'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public function district()
    {
        return $this->hasMany(Districts::class);
    }
    public function loket()
    {
        return $this->hasMany(Loket::class,'child_id','id');
    }
}
