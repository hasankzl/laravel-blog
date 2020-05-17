<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'city_id', 'id')->where('status', '1')->count();
    }
    public function getCountry()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }
}
