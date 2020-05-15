<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'country_id', 'id')->where('status', '1')->count();
    }
}
