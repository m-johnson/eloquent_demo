@extends('template')
@section('content')
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Jail Name</th>
            <th>Date Created</th>
        </tr>
        @foreach($jails as $jail)
            <tr>
                <td>{{$jail->id}}</td>
                <td>{{$jail->name}}</td>
                <td>{{$jail->created_at}}</td>
            </tr>
        @endforeach
    </table>
@endsection
