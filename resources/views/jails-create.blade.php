@extends('template')
@section('content')
    <form method="POST" action="/jails">
        @csrf
        <div class="mb-3">
            <label for="jail_name" class="form-label">Jail Name</label>
            <input type="text" name="name" class="form-control" id="jail_name" aria-describedby="jailHelp">
        </div>
        <div class="mb-3">
            <label for="admin_email" class="form-label">Admin Email</label>
            <input type="email"name="admin_email"  class="form-control" id="admin_email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" class="form-control" id="city">
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" name="state" class="form-control" id="state">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
