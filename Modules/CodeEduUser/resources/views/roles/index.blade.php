@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de roles</h3>
            {!! Button::primary('Nova role')->asLinkTo(route('codeeduuser.roles.create')) !!}
        </div>
        <br>
        <div class="row">
            {!!
                Table::withContents($roles->items())->striped()
                ->callback('Editar', function($field, $role){
                    return Button::primary('Editar')->asLinkTo(route('codeeduuser.roles.edit', ['role' => $role->id]));
                })
                ->callback('Remover', function ($field, $role){
                    $deleteForm = "delete-form-{$role->id}";
                    $form = Form::open(['route' => ['codeeduuser.roles.destroy', 'role' => $role->id],
                             'method' => 'DELETE', 'style' => 'display:none', 'id' => $deleteForm]).
                             Form::close();

                    $anchorDestroy = Button::danger('Remover')->asLinkTo(route('codeeduuser.roles.destroy', ['role' => $role->id]))
                            ->addAttributes([
                                'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteForm}\").submit();"
                            ]);

                    //$anchorDestroy = $user->id == \Auth::user()->id ? '<a href="#" class="btn btn-danger disabled" title="Não é possível excluir o próprio usuário!">Remover</a>' :$anchorDestroy;
                    return $anchorDestroy.$form;
                })
            !!}

            {{ $roles->links() }}
        </div>
    </div>


@endsection