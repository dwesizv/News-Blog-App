@extends('template.base')

@section('content')
<form action="{{ route('blog.update', $blog->id) }}" method="post">
    @csrf
    @method('put')
    <div>
        <label for="title">Title:</label>
        <input class="form-control" required id="title" minlength="4" maxlength="60" type="text" name="title" placeholder="Title of the post" value="{{ old('title', $blog->title) }}">
    </div>
    <div>
        <label for="entry">Entry:</label>
        <input class="form-control" required id="entry" minlength="20" maxlength="250" type="text" name="entry" placeholder="Entry of the post" value="{{ old('entry', $blog->entry) }}">
    </div>
    <div>
        <label for="text">Text:</label>
        <textarea cols="60" rows="8" class="form-control" minlength="40" required id="text" name="text" placeholder="Text of the post">{{ old('text', $blog->text) }}</textarea>
    </div>
    <div>
        <label for="author">Author:</label>
        <input readonly disabled class="form-control" required id="author" minlength="4" maxlength="100" type="text" name="author" placeholder="Author of the post" value="{{ old('author', $blog->author) }}">
    </div>
    <div>
        <label for="genre">Genre:</label>
        <input class="form-control" required id="genre" minlength="4" maxlength="100" type="text" name="genre" placeholder="Genre of the post" value="{{ old('genre', $blog->genre) }}">
    </div>
    <div class="upper-space" style="padding-top: 16px;">
        <input class="btn btn-primary" type="submit" value="Edit post">
    </div>
</form>
@endsection