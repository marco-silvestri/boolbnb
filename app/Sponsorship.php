<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
        'price',
        'duration',
    ];

    public function payments() {
        return $this->belongsToMany('App\Payment');
    }
}
