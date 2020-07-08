<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

    public function apartments() {
        return $this->belongsToMany('App\Apartment');
    }
}
