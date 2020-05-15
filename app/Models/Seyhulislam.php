<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seyhulislam extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'seyhulislam_id', 'id')->where('status', 1)->count();
    }
}
