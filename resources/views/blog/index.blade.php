@extends('template.base')

@section('content')

<table class="table table-hover">

    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($blogs as $blog)
        <tr>
            <td>{{ $blog->id }}</td>
            <td>{{ $blog->title }}</td>
            <td>{{ $blog->author }}</td>
            <td>
                <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-success">view</a>
                <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-warning">edit</a>
                <a data-title="{{$blog->title}}" data-href="{{ route('blog.destroy', $blog->id) }}" class="btn-delete btn btn-danger">delete</a>
                <!--<form style="display: inline;" action="{{ route('blog.destroy', $blog->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input class="btn btn-danger" type="submit" value="delete">
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th colspan="3">Number of blog items:</th>
            <th>{{ count($blogs) }}</th>
        </tr>
    </tfoot>
</table>

<form id="form-delete" action="" method="post">
    @csrf
    @method('delete')
</form>

<script>
    const formDelete = document.getElementById('form-delete');

    var elements = document.querySelectorAll('.btn-delete');
    elements.forEach(el => el.addEventListener('click', event => {
        if(confirm('¿Seguro que quieres borrar la noticia: ' + event.target.dataset.title + '?')) {
            formDelete.action = event.target.dataset.href;
            formDelete.submit();
        }
    }));

    /*if(confirm('¿Seguro que quieres borrar la noticia: "título de la noticia"?')) {
        console.log('has confirmado');
        formDelete.action = 'https://dwestarde.hopto.org/laraveles/blogApp/public/blog/1';
        formDelete.submit();
    } else {
        console.log('no has confirmado');
    }*/
</script>

<hr>

@endsection