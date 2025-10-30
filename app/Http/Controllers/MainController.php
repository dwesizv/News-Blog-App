<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller {

    function copy(): View {
        $arrayConDatos = [
            [url('https://google.es'), 'Google'],
            [url('https://bing.com'), 'Bing'],
            [route('main.index'), 'Home']
        ];
        $arrayConDatos = [
            [
                'url'  => url('https://google.es'),
                'name' =>'Google 1'
            ],
            [
                'url'  => url('https://bing.com'),
                'name' => 'Bing 2'
            ],
            [
                'url'  => route('main.index'),
                'name' => 'Home 3'
            ]
        ];
        return view('main.copy', ['navItems' => $arrayConDatos]);
    }

    function index(): View {
        $blogs = Blog::all();
        foreach($blogs as $blog) {
            $url = url('assets/img/noticia.jpg');
            if($blog->path != null) {
                $url = url('storage/' . $blog->path);
            }
            $blog->newPath = $url;
        }
        $array = ['blogs' => $blogs];
        return view('main.index', $array);
    }

}