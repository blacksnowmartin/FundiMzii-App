@extends('layout')

@section('title', $client->name . ' - FundiMzii')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>{{ $client->name }}</h1>
        <p class="text-muted">Phone: <strong>{{ $client->phone_number }}</strong></p>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('clients.export-pdf', $client) }}" class="btn btn-info">Export PDF</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Email</h6>
                <p>{{ $client->email ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Address</h6>
                <p>{{ $client->address ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Measurements</h6>
                <p class="fs-6"><strong>{{ $measurements->count() }}</strong></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Orders</h6>
                <p class="fs-6"><strong>{{ $orders->count() }}</strong></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h2>Measurements
            <a href="{{ route('measurements.create', $client) }}" class="btn btn-sm btn-success">+ Add</a>
        </h2>
        @if($measurements->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead class="table-secondary">
                        <tr>
                            <th>Date</th>
                            <th>Chest</th>
                            <th>Waist</th>
                            <th>Hip</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($measurements as $m)
                            <tr>
                                <td>{{ $m->measurement_date }}</td>
                                <td>{{ $m->chest ?? '-' }}</td>
                                <td>{{ $m->waist ?? '-' }}</td>
                                <td>{{ $m->hip ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('measurements.edit', $m) }}" class="btn btn-xs btn-warning">Edit</a>
                                    <form method="POST" action="{{ route('measurements.delete', $m) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No measurements recorded yet.</p>
        @endif
    </div>

    <div class="col-md-6">
        <h2>Orders
            <a href="{{ route('orders.create', $client) }}" class="btn btn-sm btn-success">+ Add</a>
        </h2>
        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead class="table-secondary">
                        <tr>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ substr($order->description, 0, 20) }}...</td>
                                <td>
                                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'danger' : 'warning') }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>
                                <td>{{ $order->due_date ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('orders.edit', $order) }}" class="btn btn-xs btn-warning">Edit</a>
                                    <form method="POST" action="{{ route('orders.delete', $order) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No orders recorded yet.</p>
        @endif
    </div>
</div>

@if($client->notes)
<hr>
<div>
    <h3>Notes</h3>
    <p>{{ $client->notes }}</p>
</div>
@endif
@endsection
