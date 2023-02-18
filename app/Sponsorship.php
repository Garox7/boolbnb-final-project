<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    public function properties()
    {
        return $this->belongsToMany('App\Sponsorship');
    }
}
