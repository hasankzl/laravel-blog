<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Architect extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'architect_id', 'id')->where('status', 1)->count();
    }
}
