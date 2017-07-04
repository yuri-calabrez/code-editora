@extends('layouts.app')


@section('content')
    <div class="content container">
        <h2>Checkout</h2>
        <h3>Informação do livro: {{$product->title}}</h3>

        <p>{{$product->description}}</p>
        <p>Preço: ${{$product->price}}</p>

        <div class="stripe-button">
            {!! Form::open(['url' => route('store.process', ['product' => $product->id]), 'method' => 'POST']) !!}
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
             data-key="pk_test_uo17BViAqcdzyCxRDTUQgKp9"
             data-label="Pagar com cartão"
             data-panel-label="Pagar"
             data-email="{{Auth::user()->email}}"
             data-amount="{{$product->price*100}}"
             data-name="{{config('app.name')}}"
             data-description="Livro: {{$product->title}}"
             data-locale="auto"></script>
            {!! Form::close() !!}
        </div>

    </div>
@endsection