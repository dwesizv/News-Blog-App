<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogEditRequest extends BlogCreateRequest {

    function rules(): array {
        $rules = parent::rules();
        $rules['title'] = 'required|min:4|max:60|string|unique:blog,title,' . $this->id;
        return $rules;
    }
}