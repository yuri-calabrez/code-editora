@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Cover de: <strong>{{$book->title}}</strong></h3>

            {!! Form::open(['route' => ['books.cover.store', 'book' => $book->id], 'files' => true]) !!}

                {!! Form::hidden('redirectTo', URL::previous()) !!}

                {!! Html::openFormGroup('file', $errors) !!}
                    {!! Form::label('file', 'Capa do livro (formato aceito .jpg)') !!}
                    {!! Form::file('file', ['class' => 'form-control']) !!}
                    {!! Form::error('file', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Button::primary('Upload')->submit() !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection