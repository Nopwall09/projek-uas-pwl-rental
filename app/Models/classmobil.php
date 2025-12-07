<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarClass extends Model
{
    use HasFactory;

    protected $table = 'class';
    protected $primaryKey = 'class_id';
    public $timestamps = false;

    protected $fillable = [
        'class_nama',
    ];

    public function mobils()
    {
        return $this->hasMany(Mobil::class, 'class_id', 'class_id');
    }
}
