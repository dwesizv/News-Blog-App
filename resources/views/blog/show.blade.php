@extends('template.base')

@section('content')

<table class="table table-hover">
    <tr>
        <td>#</td>
        <td>{{ $blog->id }}</td>
    </tr>
    <tr>
        <td>title</td>
        <td>{{ $blog->title }}</td>
    </tr>
    <tr>
        <td>entry</td>
        <td>{{ $blog->entry }}</td>
    </tr>
    <tr>
        <td>text</td>
        <td>{{ $blog->text }}</td>
    </tr>
    <tr>
        <td>author</td>
        <td>{{ $blog->author }}</td>
    </tr>
    <tr>
        <td>genre</td>
        <td>{{ $blog->genre }}</td>
    </tr>
</table>

@endsection