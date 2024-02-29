@extends('template')
@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <a href="/inventory/create" class="btn btn-success float-end">Add Item</a>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th width="25%'">Description</th>
                                    <th>Price</th>
                                    <th>Date Created</th>
                                </tr>
                                @foreach(\App\Models\Item::all() as $item)
                                    <tr onclick="">
                                        <td>{{$item->id}}</td>
                                        <td><a href="/items/{{$item->id}}">{{$item->name}}</a></td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->created_at->format('m/d/Y')}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
