@extends('template.base')

@section('content')
<form action="{{ route('main.postprueba') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button type="submit">Upload Image</button>
</form>
@endsection