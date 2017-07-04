@extends('layouts.app')

@section('content')
    <div class="content container">
        @if($status)
            <h2>Sua compra foi efetuada com sucesso</h2>
            <p>
                <a href="{{route('books.download-common', ['id' => $order->orderable->id])}}">Clique aqui para efuar o download</a>
            </p>
        @else
            <h2>Opss!</h2>
            <p>Seu cartão de credito fo recusado. Tente novamente</p>
        @endif
    </div>
@endsection