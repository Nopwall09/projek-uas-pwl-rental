<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';
    protected $primaryKey = 'fasilitas_id';
    public $timestamps = false;

    protected $fillable = [
        'fasilitas',
    ];

    public function mobils()
    {
        return $this->belongsToMany(Mobil::class, 'memiliki_fasilitas', 'fasilitas_id', 'mobil_id');
    }
}