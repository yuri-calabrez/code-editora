@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Nova categoria</h3>
            {!! Form::open(['route' => 'categories.store', 'class' => 'form']) !!}

                {!! Html::openFormGroup('name', $errors) !!}
                    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! Form::error('name', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup() !!}
                    {!! Form::submit('Criar categoria', ['class' => 'btn btn-primary']) !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection