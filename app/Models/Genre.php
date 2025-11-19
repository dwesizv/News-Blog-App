<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model {
    
    protected $table = 'genre';
    public $timestamps = false;
    protected $fillable = ['name'];

    //dada una genero me va a dar todos sus blogs
    function blogs() {
        return $this->hasMany('App\Models\Blog', 'idgenre');
    }
}