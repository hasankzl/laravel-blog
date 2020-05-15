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
    public function getPadisah()
    {
        return $this->hasOne('App\Models\Padisah', 'id', 'padisah_id');
    }
    public function getSeyhulislam()
    {
        return $this->hasOne('App\Models\Seyhulislam', 'id', 'seyhulislam_id');
    }
    public function getArchitect()
    {
        return $this->hasOne('App\Models\Architect', 'id', 'architect_id');
    }
    public function getCentury()
    {
        return $this->hasOne('App\Models\Century', 'id', 'century_id');
    }
    public function getCity()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }
    public function getImages()
    {
        return $this->hasMany('App\Models\Image', 'article_id', 'id');
    }
}
