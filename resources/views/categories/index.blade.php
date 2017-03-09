@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de categorias</h3>
            <a href="{{route('categories.create')}}" class="btn btn-primary" title="Criar nova categoria">Nova
                categoria</a>
        </div>

        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Editar</th>
                    <th>Remover</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td><a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                               class="btn btn-primary">Editar</a></td>
                        <td>
                            <?php $deleteForm = "delete-form-{$loop->index}"; ?>

                            <a href="{{ route('categories.destroy', ['category' => $category->id]) }}"
                               onclick="event.preventDefault(); document.getElementById('{{ $deleteForm }}').submit();"
                               class="btn btn-danger">Remover</a>

                            {!! Form::open(['route' => ['categories.destroy', 'category' => $category->id],
                             'method' => 'DELETE', 'style' => 'display:none', 'id' => $deleteForm]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $categories->links() }}
        </div>
    </div>


@endsection