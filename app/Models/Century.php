<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Century extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'century_id', 'id')->where('status', 1)->count();
    }
}
