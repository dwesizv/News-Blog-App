<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;;

class CommentController extends Controller {

    function create(): View {
    }

    function destroy(Comment $comment): RedirectResponse {
    }

    function edit(Comment $comment): View {
    }

    function index(): View {
    }

    function show(Comment $comment): View {
    }

    function store(Request $request): RedirectResponse {
    }
    
    function update(Request $request, Comment $comment): RedirectResponse {
    }
    
}