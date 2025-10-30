<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

    protected $table = 'blog';

    //los campos que se rellenan manualmente
    protected $fillable = [
        'author',
        'entry',
        'genre',
        'path',
        'text',
        'title',
    ];

    function getPath() {
        $url = url('assets/img/noticia.jpg');
        if($this->path != null) {
            $url = url('storage/' . $this->path);
        }
        return $url;
    }
}