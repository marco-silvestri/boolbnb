<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'slug',
        'room_numbers',
        'bathrooms',
        'beds',
        'square_meters',
        'address',
        'img',
        'visibility',
        'sponsorship_expiration',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function options() {
        return $this->belongsToMany('App\Option');
    }

    public function geoloc() {
        return $this->hasOne('App\Geoloc');
    }

    public function payments() {
        return $this->belongsToMany('App\Payment');
    }
}
