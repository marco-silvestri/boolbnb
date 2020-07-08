<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geoloc extends Model
{
    protected $fillable = [
       'apartment_id',
       'lat', 
       'long',
    ];
    public $timestamps = false;

    public function apartment() {
        return $this->hasOne('App\Apartment');
    }


}
