<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller {

    function index(): View {
        $blogs = Blog::all();//select * from blog;
        $array = ['blogs' => $blogs];
        return view('blog.index', $array);
        //return view('blog.index', compact('blogs'));
    }

    function create(): View {
        return view('blog.create');
    }

    function store(Request $request): RedirectResponse {
        //eloquent
        $result = false;
        $blog = new Blog($request->all());
        try {
            $result = $blog->save(); //insert into blog ...
            $path = $this->upload($request, $blog->id);
            $blog->path = $path;
            $result = $blog->save(); //update ...
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

    private function upload(Request $request, $id) {
        $path = null;
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $fileName = $id . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $fileName, 'public');
            $path = $image->storeAs('images', $fileName, 'local');
        }
        return $path;
        //dd([storage_path('app/public') . '/' . $path1, storage_path('app/private') . '/' . $path2]);
    }

    function show(Blog $blog): View {
        $year = Carbon::now()->year;
        return view('blog.show', ['blog' => $blog, 'year' => $year]);
    }

    //no me llega el blog
    function show2($id): View {//Blog $blog
        $blog = Blog::find($id);
        if($blog == null) {
            abort(404);
        } else {
            return view('blog.show', ['blog' => $blog]);
        }
    }

    function edit(Blog $blog) {
        return view('blog.edit', ['blog' => $blog]);
    }

    function update(Request $request, Blog $blog) {
        //dd($request);
        $result = false;
        if ($request->deleteimage == 'delete') {
            $blog->path = null;
        }
        try {
            // $result = $blog->update($request->all());
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

    function update2(Request $request, Blog $blog) {
        dd([$request, $blog]);
        //1º
        $blog->fill($request->all());
        $result = $blog->save();//update
        //2º
        $result = $blog->update($request->all());//update
        //3º
        $author = $blog->author;
        //$blog->fill($request->all());
        $blog->author = $author;
        $result = $blog->save();//update
    }

    function destroy(Blog $blog) {
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
}
