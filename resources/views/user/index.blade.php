@extends('template.base')

@section('content')

<!-- begin modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Seguro que quieres borrar al usuario <span id="modal-news-title">XXX</span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="form-delete" type="submit" class="btn btn-primary">Delete user</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->

<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Verificado</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->rol }}</td>
            <td>@if($user->hasVerifiedEmail()) ✓ @else X @endif</td>
            <td>
                <a href="{{ route('user.show', $user->id) }}" class="btn btn-success">view</a>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">edit</a>
                <a data-title="{{$user->name}}" data-href="{{ route('user.destroy', $user->id) }}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Number of users:</th>
            <th>{{ count($users) }}</th>
        </tr>
    </tfoot>
</table>

<form id="form-delete" action="" method="post">
    @csrf
    @method('delete')
</form>

<hr>
@endsection