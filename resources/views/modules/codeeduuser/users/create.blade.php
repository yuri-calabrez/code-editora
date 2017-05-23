@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo usuário</h3>
            {!! Form::open(['route' => 'codeeduuser.users.store', 'class' => 'form']) !!}

                @include('codeeduuser::users._form')

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Criar usuário')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection