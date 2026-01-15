<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Genre;
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

    private function limpiarCampo($campo): string {
        return $this->limpiarInput($campo, ['recent', 'title', 'genre', 'text']);
    }

    private function limpiarOrden($orden): string {
        return $this->limpiarInput($orden, ['desc', 'asc']);
    }

    private function limpiarInput($input, array $array): string {
        $valor = $array[0];
        if(in_array($input, $array)) {
            $valor = $input;
        }
        return $valor;
    }

    private function getOrderBy($orderRequest): string {
        $array = [
            'recent' => 'blog.id',
            'title'  => 'blog.title',
            'genre'  => 'genre.name',
            'text'   => 'blog.text'
        ];
        return $array[$orderRequest];
    }

    private function limpiarNumeros($numero): mixed {
        if (!is_numeric($numero) || $numero < 0) return null;
        return $numero;
    }

    /*if($q != null) {
        if($campo != 'text') {
            $blogs = Blog::where('title', 'like', '%' . $q . '%')->orderBy($campo, $orden)->paginate(10)->withQueryString();
        } else {
            $blogs = Blog::where('title', 'like', '%' . $q . '%')->orderByRaw("char_length($campo) $orden")->paginate(10)->withQueryString();
        }
    } else {
        if($campo != 'text') {
            $blogs = Blog::orderBy($campo, $orden)->paginate(10)->withQueryString();
        } else {
            $blogs = Blog::orderByRaw("char_length($campo) $orden")->paginate(10)->withQueryString();
        }
    }*/
    function index(Request $request): View {
        //dd(request()->query(), request()->except('page'));
        $campo = $this->limpiarCampo($request->campo);
        $orden = $this->limpiarOrden($request->orden);
        $q = $request->q;
        $idgenre = $request->idgenre;
        $desde = $this->limpiarNumeros($request->desde);
        $hasta = $this->limpiarNumeros($request->hasta);
        $query = Blog::query();
        $query->join('genre', 'blog.idgenre', '=', 'genre.id')->select('blog.*', 'genre.name');
        $sql = 'select b.*, g.name from blog b join genre g on b.idgenre = g.id where 1 = 1 ';
        //$sql2 = 'where 1 = 1 ';
        $paramSql = [];
        if ($desde) {
            // $query->where('char_length(text)', '>=', $desde);
            $query->whereRaw("char_length(blog.text) >= $desde");
            $sql .= 'and "char_length(b.text) >= :desde ';
            $paramSql['desde'] = $desde;
        }
        if ($hasta) {
            // $query->where('char_length(text)', '<=', $hasta);
            $query->whereRaw("char_length(blog.text) <= $hasta");
            $sql .= 'and "char_length(b.text) >= :hasta ';
            $paramSql['hasta'] = $hasta;
        }
        if($idgenre != null) {
            $query->where('blog.idgenre', '=', $idgenre);
            $sql .= 'and b.idgenre = :idgenre ';
            $paramSql['idgenre'] = $idgenre;
        }
        if($q != null) {
            //$sql2 .= 'and (title like :q1 or entry like :q2 or text like :q3 or author like :q4 or id like :q5 or idgenre like :q6) ';
            //$sql1 .= 'join genre g on b.idgenre = g.id ';
            $sql .= 'and (b.title like :q1 or b.entry like :q2 or b.text like :q3 or b.author like :q4 or b.id like :q5 or g.name like :q6) ';
            $paramSql['q1'] = '%' . $q . '%';
            $paramSql['q2'] = '%' . $q . '%';
            $paramSql['q3'] = '%' . $q . '%';
            $paramSql['q4'] = '%' . $q . '%';
            $paramSql['q5'] = '%' . $q . '%';
            $paramSql['q6'] = '%' . $q . '%';
            /*$query->where('title', 'like', '%' . $q . '%')
                    ->orWhere('entry', 'like', '%' . $q . '%')
                    ->orWhere('text', 'like', '%' . $q . '%')
                    ->orWhere('author', 'like', '%' . $q . '%')
                    ->orWhere('id', 'like', '%' . $q . '%')
                    ->orWhere('idgenre', 'like', '%' . $q . '%');*/
            $query->where(function($sq) use ($q) { //subconsulta
                $sq->where('blog.title', 'like', '%' . $q . '%')
                    ->orWhere('blog.entry', 'like', '%' . $q . '%')
                    ->orWhere('blog.text', 'like', '%' . $q . '%')
                    ->orWhere('blog.author', 'like', '%' . $q . '%')
                    ->orWhere('blog.id', 'like', '%' . $q . '%')
                    //->orWhere('idgenre', 'like', '%' . $q . '%');
                    ->orWhere('genre.name', 'like', '%' . $q . '%');
                /*$sq->orWhereHas('genre', function($ssq) use ($q) {
                    $ssq->where('name', 'like', '%' . $q . '%');
                });*/
            });
        }
        $campoOrder = $this->getOrderBy($campo);
        if($campo != 'blog.text') {
            $query->orderBy($campoOrder, $orden);
            $sql .= 'order by b.' . $campo . ' ' . $orden . ' ';
        } else {
            $query->orderByRaw("char_length($campoOrder) $orden");
            $sql .= 'order by length(b.' . $campo . ') ' . $orden . ' ';
        }
        $page = $request->page;
        if($page == null) {
            $page = 1;
        }
        $posicionInicial = ($page - 1) * 10;
        $sql .= 'limit ' . $posicionInicial . ', 10';
        //$blogsSql = DB::select($sql, $paramSql);
        //dd($blogsSql, $sql1 . ' ' . $sql2);
        $blogs = $query->paginate(10)->withQueryString();
        //dd($blogs);
        //$genres1 = Genre::all();//select * from genre
        //$genres2 = Genre::orderBy('name', 'asc')->get(); //select * from genre order by name asc
        $genres = Genre::pluck('name', 'id'); //select * from genre order by name asc, formato 
        return view('main.index', [
            'blogs'   => $blogs,
            'campo'   => $campo,
            'genres'  => $genres,
            'idgenre' => $idgenre,
            'desde'   => $desde,
            'hasta'   => $hasta,
            'orden'   => $orden,
            'q' => $q,
            //'urlDestino' => route('main.index',  ['campo' => $campo, 'orden' => $orden])
            'urlDestino' => route('main.index',  $request->except('page'))
        ]);
    }

    function indexOld(): View {
        //$blogs = Blog::all();
        $blogs = Blog::orderBy('title', 'desc')->get();
        //$blogs = Blog::orderBy('title', 'desc')->get();
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

    function responsable($iduser): View {
        $blogs = Blog::where('iduser', $iduser)->orderBy('title', 'desc')->get();
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