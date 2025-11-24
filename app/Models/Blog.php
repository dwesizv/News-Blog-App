<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model {

    protected $table = 'blog';

    protected $fillable = [
        'author',
        'entry',
        'idgenre',
        'path',
        'text',
        'title',
    ];

    
    function comments(): HasMany {
        return $this->hasMany('App\Models\Comment', 'idblog');
    }

    function genre(): BelongsTo {
        return $this->belongsTo('App\Models\Genre', 'idgenre');
    }

    function getPath(): string {
        $url = url('assets/img/noticia.jpg');
        if($this->path != null) {
            $url = url('storage/' . $this->path);
        }
        return $url;
    }
}