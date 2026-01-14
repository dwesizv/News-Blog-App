@extends('template.base')

@section('modal')
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="orderModalLabel">Ordenar artículos por ...</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul>
            <li>
                <a class="btn btn-link"
                   href="{{ route('main.index', ['campo' => 'id', 'orden' => 'desc', 'q' => $q]) }}">
                   Los artículos más recientes
                </a>
            </li>
            <li><a href="{{ route('main.index', ['campo' => 'id', 'orden' => 'desc', 'q' => $q, 'idgenre' => $idgenre]) }}" class="btn btn-outline-primary mb-1">Los articulos más recientes</a></li>
            <li><a href="{{ route('main.index', ['campo' => 'id', 'orden' => 'asc', 'q' => $q, 'idgenre' => $idgenre]) }}" class="btn btn-outline-primary mb-1">Los articulos más antiguos</a></li>
            <li><a href="{{ route('main.index', ['campo' => 'title', 'orden' => 'asc', 'q' => $q, 'idgenre' => $idgenre]) }}" class="btn btn-outline-primary mb-1">Título orden alfabético</a></li>
            <li><a href="{{ route('main.index', ['campo' => 'title', 'orden' => 'desc', 'q' => $q, 'idgenre' => $idgenre]) }}" class="btn btn-outline-primary mb-1">Título orden anti-alfabético</a></li>
            <li><a href="{{ route('main.index', ['campo' => 'idgenre', 'orden' => 'asc', 'q' => $q, 'idgenre' => $idgenre]) }}" class="btn btn-outline-primary mb-1">Género orden alfabético</a></li>
            <li><a href="{{ route('main.index', ['campo' => 'idgenre', 'orden' => 'desc', 'q' => $q, 'idgenre' => $idgenre]) }}" class="btn btn-outline-primary mb-1">Género orden anti-alfabético</a></li>
            <li><a href="{{ route('main.index', ['campo' => 'text', 'orden' => 'desc', 'q' => $q, 'idgenre' => $idgenre]) }}" class="btn btn-outline-primary mb-1">Los artículos más largos</a></li>
            <li><a href="{{ route('main.index', ['campo' => 'text', 'orden' => 'asc', 'q' => $q, 'idgenre' => $idgenre]) }}" class="btn btn-outline-primary mb-1">Los artículos más cortos</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="filterModalLabel">Filtrar artículos por ...</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
    </div>
  </div>
</div>
@endsection

@section('content')
@yield('anytitle')
<div class="mb-4">
    <a class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#orderModal">Ordenar por ...</a>
    <a class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#filterModal">Filtrar por ...</a>
</div>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-2">
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
                    | id {{ $blog->id }} 
                    | strlen {{ mb_strlen($blog->text) }} 
                    | idgenre {{ $blog->idgenre }}
                    | genre {{ $blog->genre->name }}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    </div>
                    <div>
                        <small class="text-body-secondary">Firmado: {{ $blog->author }}</small>
                        <small class="text-body-secondary">Responsable: <a href="{{ route('main.responsable', $blog->iduser) }}">{{ $blog->user->name }}</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    {{ $blogs->onEachSide(2)->links() }}
</div>

@endsection