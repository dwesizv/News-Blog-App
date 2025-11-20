@extends('template.base')

@section('scripts')
<script src="https://kit.fontawesome.com/ec3e7e2cc5.js" crossorigin="anonymous"></script>
@endsection

@section('content')
@php
//use Carbon\Carbon;
@endphp
<!-- $blog->getPath() -->
<header class="masthead" style="background-image: url('{{ route('image.view', $blog->id) }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>{{ $blog->title }}</h1>
                    <h2 class="subheading">{{ $blog->entry }}</h2>
                    <span class="meta">
                        Posted by
                        <a href="#!">{{ $blog->author }}</a>
                        on {{ $blog->created_at->format('F d, Y') }}
                        @if($blog->updated_at != $blog->created_at)
                            , updated at {{ $blog->updated_at->format('F d, Y') }}
                        @endif
                    </span>
                    <span class="meta">
                        Genre:
                        <a href="{{ route('blog.genre', $blog->idgenre) }}">{{ $blog->genre->name }}</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>{{ $blog->text }}</p>
            </div>
        </div>
    </div>
</article>
<footer class="border-top">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            <div class="small text-center text-muted fst-italic">Copyright &copy; Dwes Tarde {{ $year }}</div>
        </div>
    </div>
</footer>
@endsection