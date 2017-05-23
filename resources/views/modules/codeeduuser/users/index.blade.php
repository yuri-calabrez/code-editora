@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de usuários</h3>
            {!! Button::primary('Novo usuário')->asLinkTo(route('codeeduuser.users.create')) !!}
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
                Table::withContents($users->items())->striped()
                ->callback('Editar', function($field, $user){
                    return Button::primary('Editar')->asLinkTo(route('codeeduuser.users.edit', ['user' => $user->id]));
                })
                ->callback('Remover', function ($field, $user){
                    $deleteForm = "delete-form-{$user->id}";
                    $form = Form::open(['route' => ['codeeduuser.users.destroy', 'user' => $user->id],
                             'method' => 'DELETE', 'style' => 'display:none', 'id' => $deleteForm]).
                             Form::close();

                    $anchorDestroy = Button::danger('Remover')->asLinkTo(route('codeeduuser.users.destroy', ['user' => $user->id]))
                            ->addAttributes([
                                'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteForm}\").submit();"
                            ]);

                    $anchorDestroy = $user->id == \Auth::user()->id ? '<a href="#" class="btn btn-danger disabled" title="Não é possível excluir o próprio usuário!">Remover</a>' :$anchorDestroy;
                    return $anchorDestroy.$form;
                })
            !!}

            {{ $users->links() }}
        </div>
    </div>


@endsection