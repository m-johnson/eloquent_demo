@extends('template')
@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <a href="/jails/create" class="btn btn-success float-end">Add Jail</a>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Jail Name</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Date Created</th>
                                </tr>
                                @foreach($jails as $jail)
                                    <tr>
                                        <td>{{$jail->id}}</td>
                                        <td>{{$jail->name}}</td>
                                        <td>{{$jail->city}}</td>
                                        <td>{{$jail->state}}</td>
                                        <td>{{$jail->created_at}}</td>
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
