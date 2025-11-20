@extends('template.base')

@section('content')

@yield('anytitle')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach($blogs as $blog)
    <div class="col">
        <div class="card shadow-sm" style="min-height: 500px;">
            @php
                $url = url('assets/img/noticia.jpg');
                if($blog->path != null) {
                    $url = url('storage/' . $blog->path);
                }
            @endphp
            <!--<svg aria-label="Placeholder: Thumbnail" class="bd-placeholder-img card-img-top"
                height="225" preserveAspectRatio="xMidYMid slice" role="img" width="100%"
                xmlns="http://www.w3.org/2000/svg"
                style="background-image: url('{{ $url }}');
                       background-size: cover;
                       background-position: center center;">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c11"></rect>
                <text x="5%" y="30%" fill="#eceeef"
                    dy=".3em" style="font-weight: bold; font-size: 1.5rem;">{{ $blog->title }}</text>
            </svg>-->
            <!-- route('image.view', $blog->id) -->
            <svg aria-label="Placeholder: Thumbnail" class="bd-placeholder-img card-img-top"
                height="225" preserveAspectRatio="xMidYMid slice" role="img" width="100%"
                xmlns="http://www.w3.org/2000/svg"
                style="background-image: url('{{ $blog->getPath() }}');
                       background-size: cover;
                       background-position: center center;">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c11"></rect>
                <text x="5%" y="30%" fill="#eceeef"
                    dy=".3em" style="font-weight: bold; font-size: 1.5rem;">{{ $blog->title }}</text>
            </svg>
            <!--<svg aria-label="Placeholder: Thumbnail" class="bd-placeholder-img card-img-top"
                height="225" preserveAspectRatio="xMidYMid slice" role="img" width="100%"
                xmlns="http://www.w3.org/2000/svg"
                style="background-image: url('@if($blog->path == null){{ url('assets/img/noticia.jpg') }}@else{{ url('storage/' . $blog->path) }}@endif');
                       background-size: cover;
                       background-position: center center;">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c11"></rect>
                <text x="5%" y="30%" fill="#eceeef"
                    dy=".3em" style="font-weight: bold; font-size: 1.5rem;">{{ $blog->title }}</text>
            </svg>-->
            <div class="card-body">
                <p class="card-text">
                    {{ $blog->entry }}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    </div>
                    <small class="text-body-secondary">{{ $blog->author }}</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection