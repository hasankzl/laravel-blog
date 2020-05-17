<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'status_id', 'id')->where('status', 1)->count();
    }
}
