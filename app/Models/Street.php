<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'street_id', 'id')->where('status', '1')->count();
    }
    public function getAvenue()
    {
        return $this->hasOne('App\Models\Avenue', 'id', 'avenue_id');
    }
}
