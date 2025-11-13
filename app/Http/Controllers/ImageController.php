<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class ImageController extends Controller {

    //bd: blog, id, ..., path
    function view($id) {
        $blog = Blog::find($id);
        if($blog == null ||
                $blog->path == null ||
                !file_exists(storage_path('app/private') . '/' . $blog->path)) {
            return response()->file(base_path('public/assets/img/noimage.png'));
        }
        return response()->file(storage_path('app/private') . '/' . $blog->path);
    }
}