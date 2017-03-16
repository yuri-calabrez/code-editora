@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar categoria</h3>

            {!! Form::model($category, ['route' => ['categories.update', 'category' => $category->id],
             'class' => 'form', 'method' => 'PUT']) !!}

                {!! Html::openFormGroup('name', $errors) !!}
                    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! Form::error('name', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup() !!}
                    {!! Form::submit('Editar categoria', ['class' => 'btn btn-primary']) !!}
                {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection