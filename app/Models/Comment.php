<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model {

    protected $table = 'comment';
    protected $fillable = ['idblog', 'commentator',  'content', 'liked'];

    function blog(): BelongsTo {
        return $this->belongsTo('App\Models\Blog', 'idblog');
    }

    function isEditable(): bool {
        $sentComments = session()->get('sentComments');
        return $sentComments->isComment($this);
    }
}