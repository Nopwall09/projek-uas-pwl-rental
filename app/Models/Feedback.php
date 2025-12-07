<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';
    protected $primaryKey = 'feedback_id';
    public $timestamps = false;

    protected $fillable = [
        'rental_id',
        'rating',
        'komentar',
        'tanggal_feedback',
    ];

    protected $casts = [
        'tanggal_feedback' => 'date',
    ];

    public function rentalItem()
    {
        return $this->belongsTo(RentalItem::class, 'rental_id', 'rental_id');
    }
}