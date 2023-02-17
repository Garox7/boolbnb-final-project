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
}
