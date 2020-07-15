<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
        'price',
        'duration',
        'name'
    ];
    public  $timestamps = false;

    public function payments() {
        return $this->hasmany('App\Payment');
    }
}
