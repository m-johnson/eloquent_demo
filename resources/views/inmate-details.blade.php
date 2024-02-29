@extends('template')
@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <h3>{{$inmate->full_name ?? 'Unknown'}}</h3>
            {{--<h5><a href="/jails/{{$inmate->jail->id}}">{{$inmate->jail->name}}</a></h5>--}}
        </div>
        {{--<div class="col-12">
            <div class="row mt-4">
                <div class="col-12">
                    <a href="/inmates/{{$inmate->id}}/orders/create" class="btn btn-success float-end">Start Order</a>
                </div>
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            Orders
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Item Count</th>
                                    <th>Total</th>
                                    <th>Completed</th>
                                    <th>Date Created</th>
                                </tr>
                                @foreach($inmate->orders as $order)
                                    <tr>
                                        <td><a href="/orders/{{$order->id}}">{{$order->id}}</a></td>
                                        <td>{{$order->items->count()}}</td>
                                        <td>${{$order->items->sum('price')}}</td>
                                        <td>{{$order->completed ? 'Yes' : 'No'}}</td>
                                        <td>{{$order->created_at}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
@endsection
