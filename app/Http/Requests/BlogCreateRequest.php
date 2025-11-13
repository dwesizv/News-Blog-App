<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCreateRequest extends FormRequest {

    function attributes(): array {
        return [
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
        return [
            'title.required' => $required,
            'title.min' => $min,
            'title.max' => $max,
            'title.string' => $string,
            'entry.required' => $required,
            'entry.min' => $min,
            'entry.max' => $max,
            'author.required' => $required,
            'author.min' => $min,
            'author.max' => $max,
            'text.required' => $required,
            'text.min' => $min,
            'genre.required' => $required,
            'genre.min' => $min,
            'genre.max' => $max,
            'image.image' => $image,
            'image.max' => $maxFile,
        ];
    }
    
    function rules(): array {
        return [
            'title'  => 'required|min:4|max:60|string',
            'entry'  => 'required|min:20|max:250',
            'author' => 'required|min:4|max:100',
            'text'   => 'required|min:40',
            'genre'  => 'required|min:4|max:100',
            'image'  => 'nullable|image|max:1024',
        ];
    }
}
