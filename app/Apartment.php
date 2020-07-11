<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Apartment extends Model
{
    use Searchable;

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
        'lat',
        'long',
        'img',
        'visibility',
        'sponsorship_expiration',
        'lat',
        'long'
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

    public function payments() {
        return $this->belongsToMany('App\Payment');
    }

    public function toSearchableArray(){
        $record = $this->toArray();

        $record['_geoloc'] = [
            'lat' => $record['lat'],
            'lng' => $record['long'],
        ];

        //unset($record['created_at'], $record['updated_at']); // Remove unrelevant data
        //unset($record['latitude'], $record['longitude']);

        return $record;
    }
}
