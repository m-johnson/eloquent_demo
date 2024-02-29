@extends('template')
@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <h3>Order #{{$order->id}}</h3>
            <h5><a href="/inmates/{{$order->inmate->id}}">{{$order->inmate->full_name}}</a></h5>
        </div>
        <div class="col-12">
            <div class="row mt-4">
                <div class="col-12" style="display:flex; justify-content: space-between">
                    <a href="/orders/{{$order->id}}/items/create" class="btn btn-success float-end">Add Item</a>
                    <a href="/orders/{{$order->id}}/complete" class="btn btn-success float-end ml-2 mr-2">Complete Order</a>
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
                                    <th>Item Name</th>
                                    <th width="25%">Description</th>
                                    <th>Price</th>
                                    <th>Date Added</th>
                                </tr>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{$item->id}}</a></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>${{$item->price}}</td>
                                        <td>{{$item->pivot->created_at}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <div>
                                <h4 class="float-end">Total: ${{$order->items->sum('price')}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
