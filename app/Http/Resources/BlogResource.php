<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource {

    public function toArray(Request $request): array {
        return [
            'id'      => $this->id,
            'titulo'  => $this->title,
            'entrada' => $this->entry,
            'texto'   => $this->text,
            'autor'   => $this->author,
            'genero'   => [
                'id'     => $this->genre->id,
                'nombre' => $this->genre->name
            ]
        ];
    }
}