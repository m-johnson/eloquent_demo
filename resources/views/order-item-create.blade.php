@extends('template')
@section('content')
    <form method="POST" action="/orders/{{$order->id}}/items">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <select name="item" class="form-select" aria-label="">
                <option selected>Open this select menu</option>
                @foreach(\App\Models\Item::all() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
