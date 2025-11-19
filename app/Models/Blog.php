<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

    protected $table = 'blog';

    //los campos que se rellenan manualmente
    protected $fillable = [
        'author',
        'entry',
        'idgenre',
        'path',
        'text',
        'title',
    ];

    
    function comments() {
        return $this->hasMany('App\Models\Comment', 'idblog');
    }

    //dada una noticia blog me va a dar cuál es su género
    function genre() {
        return $this->belongsTo('App\Models\Genre', 'idgenre');
    }

    function getPath() {
        $url = url('assets/img/noticia.jpg');
        if($this->path != null) {
            $url = url('storage/' . $this->path);
        }
        return $url;
    }
}