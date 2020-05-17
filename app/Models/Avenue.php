<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avenue extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'avenue_id', 'id')->where('status', '1')->count();
    }
    public function getNeighborhood()
    {
        return $this->hasOne('App\Models\Neighborhood', 'id', 'neighborhood_id');
    }
}
