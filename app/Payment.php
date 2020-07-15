<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'apartment_id',
        'sponsorship_id',
        'status',
    ];

    public function apartments() {
        return $this->belongsToMany('App\Apartment');
    }

    public function sponsorship() {
        return $this->belongsTo('App\Sponsorship');
    }
}
