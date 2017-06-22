@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>
            <a href="{{route('books.create')}}" class="btn btn-primary" title="Criar novo livro">Novo livro</a>
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
            {!!
                Table::withContents($books->items())->striped()
                    ->callback('Exportar', function($field, $book){
                        $exportFormId = "export-form-{$book->id}";
                        $formExport = Form::open(['route' => ['books.export', 'book' => $book->id],
                             'style' => 'display:none', 'id' => $exportFormId]).
                             Form::close();

                      return Button::success('Exportar')->asLinkTo(route('books.export', ['book' => $book->id]))
                                ->addAttributes([
                                    'onclick' => "event.preventDefault(); document.getElementById(\"{$exportFormId}\").submit();"
                                ]).$formExport;
                    })
                    ->callback('Capítulos', function($field, $book){
                        return Button::normal('Capítulos')->asLinkTo(route('chapters.index', ['book' => $book->id]));
                    })
                    ->callback('Cover', function($field, $book){
                        return Button::warning('Cover')->asLinkTo(route('books.cover.create', ['book' => $book->id]));
                    })
                    ->callback('Editar', function ($field, $book){
                        return Button::primary('Editar')->asLinkTo(route('books.edit', ['book' => $book->id]));
                    })
                    ->callback('Remover', function ($field, $book){
                        $deleteForm = "delete-form-{$book->id}";
                        $form = Form::open(['route' => ['books.destroy', 'book' => $book->id],
                             'method' => 'DELETE', 'style' => 'display:none', 'id' => $deleteForm]).
                             Form::close();

                         return Button::danger('Remover para lixeira')->asLinkTo(route('books.destroy', ['book' => $book->id]))
                                ->addAttributes([
                                    'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteForm}\").submit();"
                                ]).$form;
                    })
            !!}

            {{ $books->links() }}
        </div>
    </div>


@endsection