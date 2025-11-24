<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;;

class GenreController extends Controller {

    function create(): View {
    }

    function destroy(Genre $genre): RedirectResponse {
    }

    function edit(Genre $genre): View {
    }

    function index(): View {
    }

    function show(Genre $genre): View {
    }

    function store(Request $request): RedirectResponse {
    }
    
    function update(Request $request, Genre $genre): RedirectResponse {
    }
}