@extends('layout')

@section('title', 'Clients - FundiMzii')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
    <div>
        <p class="section-kicker mb-2">Client Directory</p>
        <h1 class="mb-1">Find clients in seconds</h1>
        <p class="text-muted mb-0">Search by client name, phone number, or a date such as <strong>2026-04-07</strong>.</p>
    </div>
    <a href="{{ route('clients.create') }}" class="btn btn-primary btn-lg">+ Quick Capture</a>
</div>

<div class="app-card mb-4">
    <form method="GET" action="{{ route('clients.search') }}" class="row g-2 align-items-center">
        <div class="col-12 col-lg-10">
            <input type="text" name="search" class="form-control" placeholder="Search by name, phone, or date..." required>
        </div>
        <div class="col-12 col-lg-2">
            <button type="submit" class="btn btn-secondary w-100">Search</button>
        </div>
    </form>
</div>

<div class="app-card">
    <div class="table-responsive">
        <table class="table align-middle app-table mb-0">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Phone</th>
                    <th>Measurements</th>
                    <th>Orders</th>
                    <th>Added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                    <tr>
                        <td>
                            <strong>{{ $client->name }}</strong>
                            <div class="text-muted small">{{ $client->email ?: 'No email saved' }}</div>
                        </td>
                        <td>{{ $client->phone_number }}</td>
                        <td><span class="badge text-bg-light">{{ $client->measurements_count }}</span></td>
                        <td><span class="badge text-bg-warning-subtle">{{ $client->orders_count }}</span></td>
                        <td>{{ $client->created_at->format('d M Y') }}</td>
                        <td><a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-outline-primary">Open</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            No client records yet. <a href="{{ route('clients.create') }}">Capture the first one</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $clients->links() }}
</div>
@endsection
