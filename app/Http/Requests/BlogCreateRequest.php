<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCreateRequest extends FormRequest {

    function attributes(): array {
        return [
            'author'=> 'autor del artículo',
            'entry' => 'cabecera del artículo',
            'genre' => 'género del artículo',
            'image' => 'imagen del artículo',
            'text'  => 'texto del artículo',
            'title' => 'título del artículo',
        ];
    }

    function authorize(): bool {
        return true;
    }

    function messages(): array {
        $image = 'Sólo se permite subir imágenes, no otros tipos de archivos.';
        $max = 'El campo :attribute no puede tener más de :max caracteres.';
        $maxFile = 'El archivo no puede pesar más de :max KB.';
        $min = 'El campo :attribute no puede tener menos de :min caracteres.';
        $required = 'El campo :attribute es obligatorio.';
        $string = 'El campo :attribute tiene que ser una cadena de caracteres.';
        $unique = 'El título del artículo no se puede repetir.';
        return [
            'title.required'  => $required,
            'title.min'       => $min,
            'title.max'       => $max,
            'title.string'    => $string,
            'title.unique'    => $unique,
            'entry.required'  => $required,
            'entry.min'       => $min,
            'entry.max'       => $max,
            'entry.unique'    => '',
            'entry.rule'      => '',
            'author.required' => $required,
            'author.min'      => $min,
            'author.max'      => $max,
            'text.required'   => $required,
            'text.min'        => $min,
            'genre.required'  => $required,
            'genre.min'       => $min,
            'genre.max'       => $max,
            'image.image'     => $image,
            'image.max'       => $maxFile,
        ];
    }
    
    function rules(): array {
        return [
            'title'  => 'required|min:4|max:60|string|unique:blog,title',
            'entry'  => 'required|min:1|max:250',
            'author' => 'required|min:1|max:100',
            'text'   => 'required|min:40',
            'genre'  => 'required|min:1|max:100',
            'image'  => 'nullable|image|max:1024',
        ];
    }
}
