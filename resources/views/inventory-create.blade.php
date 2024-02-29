@extends('template')
@section('content')
    <form method="POST" action="/inventory">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="jailHelp">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" class="form-control" id="description" aria-describedby="jailHelp">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" id="price" aria-describedby="jailHelp">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
