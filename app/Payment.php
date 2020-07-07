<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'price',
        'sponsorship_duration'
    ];

    public function apartments() {
        return $this->belongsToMany('App\Apartment');
    }

    public function sponsorships() {
        return $this->belongsToMany('App\Sponsorship');
    }
}
