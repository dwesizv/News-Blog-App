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
        $array = ['blogs' => $blogs];
        return view('main.index', $array);
    }

    function prueba(): View {
        return view('main.prueba');
    }

    function postprueba(Request $request) {
        $data = $request->all();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('image');
        //$customFileName = 'my-new-image-name.' . $image->getClientOriginalExtension();
        //$path = $image->storeAs('images', $customFileName, 'public');
        $customFileName = 'second.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('images', $customFileName);
        $path = $image->store('carpeta', 'local');
        dd([$path, storage_path('app/private') . '/' . $path]);
    }

}