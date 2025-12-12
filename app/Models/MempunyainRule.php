<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MempunyaiRules extends Model
{
    protected $table = 'mempunyai_rules';
    public $timestamps = false;

    protected $fillable = [
        'rules_id',
        'user_id',
    ];

    public function rule()
    {
        return $this->belongsTo(Rules::class, 'rules_id', 'rules_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
