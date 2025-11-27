<?php

namespace App\Http\Controllers;

use App\Custom\SentComments;
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
        return view('comment.edit', ['comment' => $comment]);
    }

    function index(): View {
    }

    function show(Comment $comment): View {
    }

    function store(Request $request): RedirectResponse {
        //dd($request);
        $result = false;
        $comment = new Comment($request->all());
        try {
            $result = $comment->save();
            $message = 'The comment has been added.';
            $sentComments = session()->get('sentComments');
            $sentComments->addComment($comment);
        } catch(\Exception $e) {
            dd($e);
            $message = 'Se ha producido un error.';
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            //return redirect()->route('main.index')->with($messageArray);
            return back()->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }
    
    function update(Request $request, Comment $comment): RedirectResponse {
        $sentComments = session()->get('sentComments');
        if(!$sentComments->isComment($comment)) {
            return redirect()->route('main.index');
        }
        $result = false;
        try {
            $comment->fill($request->all());
            $result = $comment->save();
            //$result = $comment->update($request->all());
            $message = 'The comment has been edited.';
        } catch(\Exception $e) {
            $message = 'Se ha producido un error, en caso de que persista, consulte al administrador.';
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            return redirect()->route('blog.show', $comment->idblog)->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }
    
}