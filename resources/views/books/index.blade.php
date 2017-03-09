@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>
            <a href="{{route('books.create')}}" class="btn btn-primary" title="Criar novo livro">Novo livro</a>
        </div>

        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Subtitulo</th>
                    <th>Valor</th>
                    <th>Editar</th>
                    <th>Remover</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->subtitle }}</td>
                        <td>{{ number_format($book->price, 2, ',', '.') }}</td>
                        <td><a href="{{ route('books.edit', ['book' => $book->id]) }}"
                               class="btn btn-primary">Editar</a></td>
                        <td>
                            <?php $deleteForm = "delete-form-{$loop->index}"; ?>

                            <a href="{{ route('books.destroy', ['book' => $book->id]) }}"
                               onclick="event.preventDefault(); document.getElementById('{{ $deleteForm }}').submit();"
                               class="btn btn-danger">Remover</a>

                            {!! Form::open(['route' => ['books.destroy', 'book' => $book->id],
                             'method' => 'DELETE', 'style' => 'display:none', 'id' => $deleteForm]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $books->links() }}
        </div>
    </div>


@endsection