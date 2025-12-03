@extends('template.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de administración</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Estás logueado.
                    <br>
                    {{ Auth::user()->name }}<br>
                    {{ Auth::user()->email }}<br>
                    {{ Auth::user()->password }}<br>
                    <a href="{{ route('home.edit') }}">Editar perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
