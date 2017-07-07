@extends('layouts.app')


@section('content')
    <div class="container">
        <h2>Minhas faturas</h2>

        <table class="table table-bordered">
            <thead>
            <th>Data</th>
            <th>Id do pedido</th>
            <th>Valor</th>
            </thead>
            <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{$invoice->date()->format('d/m/Y')}}</td>
                    <td>{{$invoice->id}}</td>
                    <td>{{$invoice->total()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection