@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de categorias</h3>
            {!! Button::primary('Nova categoria')->asLinkTo(route('categories.create')) !!}
        </div>
        <br>
        <div class="row">
            {!! Form::model(compact('search'), ['method' => 'GET', 'class' => 'form-inline']) !!}
                {!! Form::label('search', 'Pesquisar por nome:', ['class' => 'control-label']) !!}
                {!! Form::text('search', null, ['class' => 'form-control']) !!}

                {!! Button::primary('Pesquisar')->submit() !!}
            {!! Form::close() !!}
        </div>

        <div class="row">
            {!!
                Table::withContents($categories->items())->striped()
                ->callback('Editar', function($field, $category){
                    return Button::primary('Editar')->asLinkTo(route('categories.edit', ['category' => $category->id]));
                })
                ->callback('Remover', function ($field, $category){
                    $deleteForm = "delete-form-{$category->id}";
                    $form = Form::open(['route' => ['categories.destroy', 'category' => $category->id],
                             'method' => 'DELETE', 'style' => 'display:none', 'id' => $deleteForm]).
                             Form::close();

                    return Button::danger('Remover')->asLinkTo(route('categories.destroy', ['category' => $category->id]))
                            ->addAttributes([
                                'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteForm}\").submit();"
                            ]).$form;
                })
            !!}

            {{ $categories->links() }}
        </div>
    </div>


@endsection