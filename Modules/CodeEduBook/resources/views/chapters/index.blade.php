@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Capítulos de: <strong>{{$book->title}}</strong></h3>
            <a href="{{route('chapters.create', ['book' => $book->id])}}" class="btn btn-primary" title="Novo capítulo">Novo
                capítulo</a>
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
                Table::withContents($chapters->items())->striped()
                    ->callback('Editar', function ($field, $chapter) use ($book){
                        return Button::primary('Editar')->asLinkTo(route('chapters.edit', ['book' => $book->id, 'chapter' => $chapter->id]));
                    })
                    ->callback('Remover', function ($field, $chapter) use ($book){
                        $deleteForm = "delete-form-{$chapter->id}";
                        $form = Form::open(['route' => ['chapters.destroy', 'book' => $book->id, 'chapter' => $chapter->id],
                             'method' => 'DELETE', 'style' => 'display:none', 'id' => $deleteForm]).
                             Form::close();

                         return Button::danger('Remover')->asLinkTo(route('chapters.destroy',
                         ['book' => $book->id, 'chapter' => $chapter->id]))
                                ->addAttributes([
                                    'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteForm}\").submit();"
                                ]).$form;
                    })
            !!}

            {{ $chapters->links() }}
        </div>
    </div>


@endsection