@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>
        </div>
        <br>
        <div class="row">
            {!! Form::model(compact('search'), ['method' => 'GET', 'class' => 'form-inline']) !!}
            {!! Form::label('search', 'Pesquisar por título:', ['class' => 'control-label']) !!}
            {!! Form::text('search', null, ['class' => 'form-control']) !!}

            {!! Button::primary('Pesquisar')->submit() !!}
            {!! Form::close() !!}
        </div>

        <div class="row">
            @if($books->count() > 0)
                {!!
                    Table::withContents($books->items())->striped()
                        ->callback('Ver', function ($field, $book){
                            return Button::primary('Ver')->asLinkTo(route('trashed.books.show', ['book' => $book->id]));
                        })
                        ->callback('Remover', function ($field, $book){
                            $restoreForm = "restore-form-{$book->id}";
                            $form = Form::open(['route' => ['trashed.books.update', 'book' => $book->id],
                                 'method' => 'PUT', 'style' => 'display:none', 'id' => $restoreForm]).
                                 Form::hidden('redirectTo', URL::previous()).
                                 Form::close();

                             return Button::danger('Restaurar Livro')->asLinkTo(route('books.destroy', ['book' => $book->id]))
                                    ->addAttributes([
                                        'onclick' => "event.preventDefault(); document.getElementById(\"{$restoreForm}\").submit();"
                                    ]).$form;
                        })
                !!}
            @else
                <br>
                <div class="alert alert-info text-center"><strong>Não existem livros na sua lixeira!</strong></div>
            @endif

            {{ $books->links() }}
        </div>
    </div>


@endsection