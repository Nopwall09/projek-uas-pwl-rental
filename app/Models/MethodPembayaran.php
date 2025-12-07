<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodPembayaran extends Model
{
    use HasFactory;

    protected $table = 'method_pembayaran';
    protected $primaryKey = 'method_id';
    public $timestamps = false;

    protected $fillable = [
        'method',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'method_id', 'method_id');
    }
}

