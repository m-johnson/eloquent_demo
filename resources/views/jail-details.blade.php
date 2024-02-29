@extends('template')
@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <h3>{{$jail->name}}</h3>
        </div>
        <div class="col-12">
            <div class="row mt-4">
                <div class="col-12">
                    <a href="/jails/{{$jail->id}}/inmates/create" class="btn btn-success float-end">Add Inmate</a>
                </div>
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            Inmates
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Inmate ID</th>
                                    <th>Date Created</th>
                                </tr>
                                @foreach($jail->inmates as $inmate)
                                    <tr>
                                        <td>{{$inmate->id}}</td>
                                        <td><a href="/inmates/{{$inmate->id}}">{{$inmate->first_name}}</a></td>
                                        <td><a href="/inmates/{{$inmate->id}}">{{$inmate->last_name}}</a></td>
                                        <td>{{$inmate->xref_id}}</td>
                                        <td>{{$inmate->created_at}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="col-12">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Open Orders
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Item Count</th>
                                    <th>Total</th>
                                    <th>Date Created</th>
                                </tr>
                                @foreach($orders as $order)
                                    <tr>
                                        <td><a href="/orders/{{$order->id}}">{{$order->id}}</a></td>
                                        <td>{{$order->inmate->first_name}}</td>
                                        <td>{{$order->inmate->last_name}}</td>
                                        <td>{{$order->items->count()}}</td>
                                        <td>${{$order->items->sum('price')}}</td>
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
