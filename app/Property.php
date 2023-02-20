<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function user()
    {
        return $this->belongsTo('App\user');
    }

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    public function property_images()
    {
        return $this->hasMany('App\PropertyImages');
    }

    public function sponsorships()
    {
        return $this->belongsToMany('App\Sponsorship');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
