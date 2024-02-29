@extends('template')
@section('content')
    <form method="POST" action="/jails/{{$jail->id}}/inmates">
        @csrf
        <input type="hidden" name="jail" value="{{$jail->id}}">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" aria-describedby="jailHelp">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="jailHelp">
        </div>
        <div class="mb-3">
            <label for="xref_id" class="form-label">Xref ID</label>
            <input type="number" name="xref_id" class="form-control" id="xref_id" aria-describedby="jailHelp">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
