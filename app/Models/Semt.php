<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semt extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'semt_id', 'id')->where('status', '1')->count();
    }

    public function getCity()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }
}
