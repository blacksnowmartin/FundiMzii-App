@extends('layout')

@section('title', 'Clients - FundiMzii')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Clients</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('clients.create') }}" class="btn btn-primary btn-lg">
            + New Client
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <form method="GET" action="{{ route('clients.search') }}" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Search by name or phone..." required>
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>
</div>

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
            @forelse($clients as $client)
                <tr>
                    <td><strong>{{ $client->name }}</strong></td>
                    <td>{{ $client->phone_number }}</td>
                    <td>{{ $client->email ?? '-' }}</td>
                    <td>
                        <span class="badge bg-info">{{ $client->measurements_count ?? 0 }}</span>
                    </td>
                    <td>
                        <span class="badge bg-warning">{{ $client->orders_count ?? 0 }}</span>
                    </td>
                    <td>
                        <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No clients found. <a href="{{ route('clients.create') }}">Create one</a></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $clients->links() }}
</div>
@endsection
