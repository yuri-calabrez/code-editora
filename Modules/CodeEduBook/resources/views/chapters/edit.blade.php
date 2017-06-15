@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar capítulo - Livro: <strong>{{$book->title}}</strong></h3>

            {!! Form::model($chapter, ['route' => ['chapters.update', 'book' => $book->id, 'chapter' => $chapter->id],
            'method' => 'PUT', 'class' => 'form']) !!}

                @include('codeedubook::chapters._form')

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Editar capítulo')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection