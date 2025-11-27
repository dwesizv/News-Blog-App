<?php

namespace App\Http\Controllers;

use App\Custom\SentComments;
use App\Http\Requests\BlogCreateRequest;
use App\Http\Requests\BlogEditRequest;
use App\Models\Blog;
use App\Models\Genre;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogController extends Controller {

    function create(): View {
        $genres = Genre::pluck('name', 'id');
        return view('blog.create', ['genres' => $genres]);
    }

    function destroy(Blog $blog): RedirectResponse {
        try {
            $result = $blog->delete();
            $message = 'The new has been deleted.';
        } catch(\Exception $e) {
            $result = false;
            $message = 'The new has not been deleted.';
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            return redirect()->route('blog.index')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }
    private function destroyImage($file): void {
        Storage::delete($file);
    }

    function edit(Blog $blog): View {
        $genres = Genre::pluck('name', 'id');
        return view('blog.edit', [
            'blog'   => $blog,
            'genres' => $genres, 
        ]);
    }

    function genre(Genre $genre): View {
        return view('blog.genre', ['genre' => $genre, 'blogs' => $genre->blogs]);
    }

    function genre2($idgenre): View {
        $genre = Genre::find($idgenre);
        if($genre == null) {
            abort(404);
        } else {
            return view('', []);
        }
    }

    function index(): View {
        $blogs = Blog::all();
        $array = ['blogs' => $blogs];
        return view('blog.index', $array);
    }

    function show(Blog $blog): View {
        $sentComments = session()->get('sentComments');
        if($sentComments == null) {
            $sentComments = new SentComments();
            session()->put('sentComments', $sentComments);
        }
        $year = Carbon::now()->year;
        return view('blog.show', ['blog' => $blog, 'year' => $year, 'sentComments' => $sentComments]);
    }

    function show2($id): View {
        $blog = Blog::find($id);
        if($blog == null) {
            abort(404);
        } else {
            return view('blog.show', ['blog' => $blog]);
        }
    }

    /**
     * Tres formas de validación:
     * 1. Directamente en el método, con $request->validate([...])
     * primera forma: sencilla pero sin poder personalizar los mensajes
        $validatedData = $request->validate([
            'title'  => 'required|min:4|max:60|string',
            'entry'  => 'required|min:20|max:250',
            'author' => 'required|min:4|max:100',
            'text'   => 'required|min:40',
            'genre'  => 'required|min:4|max:100',
            'image'  => 'nullable|image|max:1',
        ]);
     * 2. Creando un FormRequest (BlogCreateRequest) y usándolo como tipo del parámetro $request
     * 3. Creando un validador manual, personalizando los mensajes, combrobando si falla
       $rules = [
            'title'  => 'required|min:4|max:60|string',
            'text'   => 'required|min:40',
        ];
        $messages = [
            'title.required' => 'El campo título es obligatorio.',
            'title.min'      => 'El campo título ha de terner al menos 4 caracteres',
            'title.max'      => 'a',
            'title.string'   => 'b',
            'text.required'  => 'c',
            'text.min'       => 'd'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
     */
    function store(BlogCreateRequest $request): RedirectResponse {
        // validando clave única compuesta
        $rules = [
            'author' => [
                'min:20',
                Rule::unique('blog')
                    ->where(function ($query) use ($request) {
                        return $query->where('entry', $request->author);
                    }),
            ],
        ];
        $validator = Validator::make($request->all(), $rules, []);
        if($validator->fails()) {
            $messages = [
                'entry' => 'clave unica violada',
                'author' => 'clave unica violada'
            ];
            return back()->withInput()->withErrors($messages);
        }
        $result = false;
        $blog = new Blog($request->all());
        try {
            $result = $blog->save();
            $path = $this->upload($request, $blog->id);
            $blog->path = $path;
            $result = $blog->save();
            $message = 'The new has been added.';
        } catch(UniqueConstraintViolationException $e) {
            $message = 'The same author could not write the same entry.';
        } catch(QueryException $e) {
            $message = 'Any of the entries is null.';
        } catch(\Exception $e) {
            $message = 'Se ha producido un error, en caso de que persista, consulte al administrador.';
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            return redirect()->route('main.index')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }

    function update(BlogEditRequest $request, Blog $blog): RedirectResponse {
        $result = false;
        if ($request->deleteimage == 'delete') {
            $this->destroyImage(storage_path(storage_path('app/public') . '/' . $blog->path));
            $this->destroyImage(storage_path(storage_path('app/private') . '/' . $blog->path));
            $blog->path = null;
        }
        try {
            $path = $this->upload($request, $blog->id);
            if ($path != null) {
                $blog->path = $path;
            }
            $result = $blog->update($request->all());
            $message = 'The new has been edited.';
        } catch(UniqueConstraintViolationException $e) {
            $message = 'The same author could not write the same entry.';
        } catch(QueryException $e) {
            $message = 'Any of the entries is null.';
        } catch(\Exception $e) {
            $message = 'Se ha producido un error, en caso de que persista, consulte al administrador.';
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            return redirect()->route('blog.edit', $blog->id)->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }

    private function upload(Request $request, $id): string {
        $path = null;
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $fileName = $id . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $fileName, 'public');
            $path = $image->storeAs('images', $fileName, 'local');
        }
        return $path;
    }

}