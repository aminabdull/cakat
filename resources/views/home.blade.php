@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table" width="100%">
                        <thead>
                            <tr>
                                <th title="Field #1"> Date</th>
                                <th title="Field #2"> User</th>
                                <th title="Field #3"> Score</th>
                                <th title="Field #6"> Time Taken</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($score as $data)
                            <tr>
                                <td> {{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                <td> {{ $data->username }}</td>
                                <td> {{ $data->score }}</td>
                                <td> {{ $data->time }}s</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
