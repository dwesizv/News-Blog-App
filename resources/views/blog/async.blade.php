@extends('template.base')

@section('modal')
<!-- begin modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="xModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="xModalLabel">Edit noticia</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form id="editForm">
            <div>
                <label for="title">Title:</label>
                <input class="form-control" id="title" name="title" minlength="4" maxlength="60" type="text" placeholder="Title of the post" value="">
            </div>
            <div>
                <label for="entry">Entry:</label>
                <input class="form-control" id="entry" name="entry" minlength="20" maxlength="250" type="text" placeholder="Entry of the post" value="">
            </div>
            <div>
                <label for="text">Text:</label>
                <textarea cols="60" rows="8" class="form-control" minlength="40" id="text" name="text" placeholder="Text of the post"></textarea>
            </div>
            <div>
                <label for="author">Author:</label>
                <input readonly disabled class="form-control" id="author" name="author" minlength="4" maxlength="100" type="text" placeholder="Author of the post" value="">
            </div>
            <div>
                <label for="idgenre">Genre:</label>
                <input class="form-control" id="idgenre" name="idgenre" minlength="4" maxlength="100" type="text" placeholder="Genre of the post" value="">
            </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="editButton" class="btn btn-primary">Edit</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->
@endsection

@section('content')
<table class="table table-hover">

    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>User</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody id="fetchAllResult">
        <!--<tr>
            <td>id</td>
            <td>title</td>
            <td>author</td>
            <td>user name</td>
            <td>
                <a href="#" class="btn btn-success">view</a>
                <a href="#" class="btn btn-warning">edit</a>
                <a data-title="" data-href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</a>
            </td>
        </tr>-->
    </tbody>

    <tfoot>
        <tr>
            <th colspan="4">Number of blog items:</th>
            <th></th>
        </tr>

    </tfoot>
</table>

<hr>

@endsection

@section('scripts')
<script type="module" src="{{ url('assets/js/script.js?r=' . rand(1, 10000)) }}"></script>
@endsection