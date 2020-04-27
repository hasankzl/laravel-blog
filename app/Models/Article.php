<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    //
    use SoftDeletes;
    public function getCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    public function getMaker()
    {
        return $this->hasOne('App\Models\Maker', 'id', 'maker_id');
    }
    public function getCity()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }
}
