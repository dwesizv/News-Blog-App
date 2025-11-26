<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model {
    
    protected $table = 'genre';
    public $timestamps = false;
    protected $fillable = ['name'];

    //usado
    function blogs(): HasMany {
        return $this->hasMany('App\Models\Blog', 'idgenre');
    }
}