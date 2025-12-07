<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    use HasFactory;

    protected $table = 'merk';
    protected $primaryKey = 'merk_id';
    public $timestamps = false;

    protected $fillable = [
        'merk_nama',
    ];

    public function mobils()
    {
        return $this->hasMany(Mobil::class, 'merk_id', 'merk_id');
    }
}

