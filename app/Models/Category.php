<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table='categories';


    public function articleCount()
    {
        return $this->hasMany('App\Models\Article', 'category_id', 'id')->where('status', 1)->count();
    }                       // Bağlantı modeli , Bağlanılacak sutun // bağlanılacak id
}
