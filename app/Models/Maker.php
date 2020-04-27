<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'maker_id', 'id')->where('status', 1)->count();
    }
}
