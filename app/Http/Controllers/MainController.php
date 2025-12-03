<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MainController extends Controller {

    function db(Request $request) {
        $valor = $request->valor;
        $inicio1 = microtime(true);
        $blogs1 = Blog::where('idgenre', $valor)->orderBy('title')->get();
        //$blogs1 = Blog::orderBy('title')->get();
        $fin1 = microtime(true);
        //sentencia SQL ¡¡¡preparada!!!
        //$blogs2 = DB::select('select * from blog where idgenre = ? order by title');
        $inicio2 = microtime(true);
        $blogs2 = DB::select('select * from blog where idgenre = :idgenre order by title', ['idgenre' => $valor]);
        $blogs2 = DB::select('select * from blog where idgenre = ' . $valor . ' order by title');
        //$blogs2 = DB::select('select * from blog order by title');
        $fin2 = microtime(true);
        $pdo = DB::connection()->getPdo();
        $sql = 'select * from blog where idgenre = :idgenre order by title';
        $inicio3 = microtime(true);
        $sentence = $pdo->prepare($sql);
        $sentence->bindValue('idgenre', $valor);
        $sentence->execute();
        $blogs3 = [];
        foreach($sentence as $row) {
            $blogs3[] = $row;
        }
        $fin3 = microtime(true);
        $pdo = DB::connection()->getPdo();
        $sql = 'select * from blog where idgenre = ' . $valor . ' order by title';
        $inicio4 = microtime(true);
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $blogs4 = [];
        foreach($sentence as $row) {
            $blogs4[] = $row;
        }
        $fin4 = microtime(true);
        dd($blogs1, $blogs2, $blogs3, $blogs4, $fin1 - $inicio1, $fin2 - $inicio2, $fin3 - $inicio3, $fin4 - $inicio4);
    }

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
        //$blogs = Blog::all();
        $blogs = Blog::orderBy('title', 'desc')->get();
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

    function imagenes(): View {
        return view('main.imagenes');
    }

    function privada(): BinaryFileResponse {
        return response()->file(storage_path('app/private/images/image.jpg'));
    }

    function privadaPhp(): Response {
        readfile(storage_path('app/private/images/image.jpg'));
    }
}