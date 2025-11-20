@extends('template.base')

@section('content')
<form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
    <!-- enctype="application/x-www-form-urlencoded" -->
    @csrf
    <div>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="title">Title:</label>
        <input class="form-control" required id="title" minlength="1" maxlength="60" type="text" name="title" placeholder="Title of the post" value="{{ old('title') }}">
    </div>
    <div>
        @error('entry')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="entry">Entry:</label>
        <input class="form-control" required id="entry" minlength="1" maxlength="250" type="text" name="entry" placeholder="Entry of the post" value="{{ old('entry') }}">
    </div>
    <div>
        @error('text')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="text">Text:</label>
        <textarea cols="60" rows="8" class="form-control" minlength="1" required id="text" name="text" placeholder="Text of the post">{{ old('text') }}</textarea>
    </div>
    <div>
        @error('author')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="author">Author:</label>
        <input class="form-control" required id="author" minlength="1" maxlength="100" type="text" name="author" placeholder="Author of the post" value="{{ old('author') }}">
    </div>
    <div>
        @error('idgenre')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="idgenre">Genre:</label>
        <!--<input class="form-control" required id="genre" minlength="1" maxlength="100" type="text" name="genre" placeholder="Genre of the post" value="{{ old('genre') }}">-->
        <!-- The second value will be selected initially -->
        <select required name="idgenre" id="idgenre" class="form-control">
            <option value=""
                @if(old('idgenre') == null)
                    selected
                @endif
            disabled>Selecciona una opción...</option>
            @foreach($genres as $i => $genre)
                <option value="{{ $i }}"
                    @if($i == old('idgenre'))
                        selected
                    @endif
                >{{ $genre }}</option>
            @endforeach
        </select>
    </div>
    <div>
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="image">Image:</label>
        <input class="form-control" id="image" type="file" name="image" accept="image/*">
        <!-- mimetypes -->
        <!-- consideraciones: 1 - zona aterrizaje, 2 - ocultar control y 3 - miniatura -->
    </div>
    <div class="upper-space" style="padding-top: 16px;">
        <input class="btn btn-primary" type="submit" value="Create new post">
    </div>
</form>
@endsection