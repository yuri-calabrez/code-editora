@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar livro</h3>

            {!! Form::model($book, ['route' => ['books.update', 'book' => $book->id],
            'method' => 'PUT', 'class' => 'form']) !!}

                {!! Html::openFormGroup('title', $errors) !!}
                    {!! Form::label('title', 'Titulo', ['class' => 'control-label']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    {!! Form::error('title', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup('subtitle', $errors) !!}
                    {!! Form::label('subtitle', 'Subtitulo') !!}
                    {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
                    {!! Form::error('subtitle', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup('price', $errors) !!}
                    {!! Form::label('price', 'Valor') !!}
                    {!! Form::text('price', null, ['class' => 'form-control']) !!}
                    {!! Form::error('price', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup() !!}
                    {!! Form::submit('Editar livro', ['class' => 'btn btn-primary']) !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection