@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>
            <a href="{{route('books.create')}}" class="btn btn-primary" title="Criar novo livro">Novo livro</a>
        </div>

        <div class="row">
            {!!
                Table::withContents($books->items())->striped()
                    ->callback('Editar', function ($field, $book){
                        return Button::primary('Editar')->asLinkTo(route('books.edit', ['book' => $book->id]));
                    })
                    ->callback('Remover', function ($field, $book){
                        $deleteForm = "delete-form-{$book->id}";
                        $form = Form::open(['route' => ['books.destroy', 'book' => $book->id],
                             'method' => 'DELETE', 'style' => 'display:none', 'id' => $deleteForm]).
                             Form::close();

                         return Button::danger('Remover')->asLinkTo(route('books.destroy', ['book' => $book->id]))
                                ->addAttributes([
                                    'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteForm}\").submit();"
                                ]).$form;
                    })
            !!}

            {{ $books->links() }}
        </div>
    </div>


@endsection