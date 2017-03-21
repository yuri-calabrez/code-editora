@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar livro</h3>

            {!! Form::model($book, ['route' => ['books.update', 'book' => $book->id],
            'method' => 'PUT', 'class' => 'form']) !!}

                @include('books._form')

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Editar livro')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection