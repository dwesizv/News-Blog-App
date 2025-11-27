<?php

namespace App\Custom;

use App\Models\Comment;
use Carbon\Carbon;

class SentComments {

    private $comments = [];

    function addComment(Comment $comment): void {
        $this->comments[] = $comment->id;
    }

    function isComment(Comment $comment): bool {
        return (Carbon::now()->diffInMinutes($comment->updatedAt) < 10) && 
                in_array($comment->id, $this->comments);
    }
}