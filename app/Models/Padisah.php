<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Padisah extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'padisah_id', 'id')->where('status', 1)->count();
    }
}
