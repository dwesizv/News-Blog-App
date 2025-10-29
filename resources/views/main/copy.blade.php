@extends('template.copybase')

@section('nav-items')

    @foreach($navItems as $item)
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ $item['url'] }}">{{ $item['name'] }}</a>
    </li>
    @endforeach

@endsection