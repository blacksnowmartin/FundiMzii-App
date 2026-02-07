@extends('layout')

@section('title', 'Search Results - FundiMzii')

@section('content')
<h1>Search Results for "{{ $query }}"</h1>

@if($clients->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Measurements</th>
                    <th>Orders</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td><strong>{{ $client->name }}</strong></td>
                        <td>{{ $client->phone_number }}</td>
                        <td>{{ $client->email ?? '-' }}</td>
                        <td><span class="badge bg-info">{{ $client->measurements->count() }}</span></td>
                        <td><span class="badge bg-warning">{{ $client->orders->count() }}</span></td>
                        <td>
                            <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-info">No clients found matching "{{ $query }}"</div>
@endif

<a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to Clients</a>
@endsection
