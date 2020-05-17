<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'neighborhood_id', 'id')->where('status', '1')->count();
    }
    public function getDistrict()
    {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }
}
