@extends('template')
@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Jail</th>
                                    <th>Inmate ID</th>
                                    <th>Date Created</th>
                                </tr>
                                @foreach(\App\Models\Inmate::all() as $inmate)
                                    <tr>
                                        <td>{{$inmate->id}}</td>
                                        <td><a href="/inmates/{{$inmate->id}}">{{$inmate->first_name}}</a></td>
                                        <td><a href="/inmates/{{$inmate->id}}">{{$inmate->last_name}}</a></td>
                                        <td>{{$inmate->jail->name}}</td>
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
    </div>
@endsection
