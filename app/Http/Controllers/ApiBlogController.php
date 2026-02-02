<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Resources\BlogResource;
use App\Trait\JsonTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiBlogController extends Controller
{

    use JsonTrait;

    public function index(): JsonResponse {
        sleep(1);
        $blogs = Blog::with('genre', 'user')->paginate(10);
        //return $this->jsonResponse(BlogResource::collection($blogs), 'blog list');
        return $this->jsonResponse($blogs, 'blog list');
    }

    public function store(Request $request): JsonResponse {
        $blog = new Blog($request->all());
        try {
            $success = true;
            $blog->save();
            $result = new BlogResource($blog);
        } catch(\Exception $e) {
            $success = false;
            $result = $e->getMessage();
        }
        return $this->jsonResponse($result, 'create', $success);
    }

    public function show(string $id): JsonResponse {
        sleep(2);
        $blog = Blog::with('genre', 'user')->find($id);
        //$blog = Blog::find($id);
        //$blog->load('genre');
        //$blog->load('user');
        $success = false;
        $code = 404;
        if($blog) {
            $success = true;
            $code = 200;
            $blog = new BlogResource($blog);
        }
        //if(request()->expectsJson()) {
            return $this->jsonResponse($blog, 'item', $success);
        /*} else {
            return response(
                '<?xml version="1.0" encoding="UTF-8"?>
                <response>
                    <status>ok</status>
                    <message>Todo correcto</message>
                </response>',
                200,
                ['Content-Type' => 'application/xml']
            );
        }*/
    }

    public function update(Request $request, string $id): JsonResponse {
        $blog = Blog::find($id);
        $success = false;
        $result = null;
        if($blog) {
            try {                
                $blog->update($request->all());
                $result = new BlogResource($blog);
                $success = true;
            } catch(\Exception $e) {
            }
        }
        return $this->jsonResponse($result, 'update', $success);
    }

    public function destroy(string $id): JsonResponse {
        try {
            $success = true;
            $result = Blog::destroy($id);
        } catch(\Exception $e) {
            $result = 0;
            $success = false;
        }
        return $this->jsonResponse($result, 'destroy', $success);
    }
}