@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo capítulo - Livro: <strong>{{$book->title}}</strong></h3>

            {!! Form::open(['route' => ['chapters.store', 'book' => $book->id], 'class' => 'form']) !!}

                @include('codeedubook::chapters._form')

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Cadastrar capítulo')->submit() !!}
                {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection