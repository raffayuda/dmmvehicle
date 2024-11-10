<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $primaryKey = 'kategori_id';
    public function produk(){
        return $this->hasMany('App\Produk','kategori_id');
    }
}
