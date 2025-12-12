<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    use HasFactory;

    protected $table = 'rules';
    protected $primaryKey = 'rules_id';
    public $timestamps = false;

    protected $fillable = [
        'rules',
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'mempunyai_rules',
            'rules_id',
            'user_id',
            'rules_id',
            'user_id'
        );
    }

}
