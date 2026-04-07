@extends('layout')

@section('title', 'Search Results - FundiMzii')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
    <div>
        <p class="section-kicker mb-2">Search Results</p>
        <h1 class="mb-1">Results for "{{ $query }}"</h1>
        <p class="text-muted mb-0">Matches can come from client details, measurement dates, or order dates.</p>
    </div>
    <a href="{{ route('clients.index') }}" class="btn btn-light">Back to Clients</a>
</div>

@if($clients->count() > 0)
    <div class="app-card">
        <div class="table-responsive">
            <table class="table align-middle app-table mb-0">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Phone</th>
                        <th>Measurements</th>
                        <th>Orders</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>
                                <strong>{{ $client->name }}</strong>
                                <div class="text-muted small">{{ $client->created_at->format('d M Y') }}</div>
                            </td>
                            <td>{{ $client->phone_number }}</td>
                            <td><span class="badge text-bg-light">{{ $client->measurements_count }}</span></td>
                            <td><span class="badge text-bg-warning-subtle">{{ $client->orders_count }}</span></td>
                            <td><a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-outline-primary">Open</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="alert alert-info">No records matched "{{ $query }}". Try a name, phone number, or full date like 2026-04-07.</div>
@endif
@endsection
