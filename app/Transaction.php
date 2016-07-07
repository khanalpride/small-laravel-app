<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'approved'
    ];

    protected $casts = [
      'approved' => 'boolean',
      'amount' => 'float'
    ];

    public function creator() {
      return $this->belongsTo(User::class, 'user_id');
    }


}
