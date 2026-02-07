@extends('layout')

@section('title', 'Dashboard - FundiMzii')

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-start border-5 border-primary">
            <div class="card-body">
                <h6 class="card-title text-muted">Total Clients</h6>
                <h2 class="text-primary">{{ $totalClients }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-start border-5 border-info">
            <div class="card-body">
                <h6 class="card-title text-muted">Total Orders</h6>
                <h2 class="text-info">{{ $totalOrders }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-start border-5 border-warning">
            <div class="card-body">
                <h6 class="card-title text-muted">Pending Orders</h6>
                <h2 class="text-warning">{{ $pendingOrders }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-start border-5 border-success">
            <div class="card-body">
                <h6 class="card-title text-muted">Completed Orders</h6>
                <h2 class="text-success">{{ $completedOrders }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <strong>Recent Clients</strong>
            </div>
            <div class="card-body">
                @if($recentClients->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($recentClients as $client)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $client->name }}</strong><br>
                                    <small class="text-muted">{{ $client->phone_number }}</small>
                                </div>
                                <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-primary">View</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No clients yet</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <strong>Recent Orders</strong>
            </div>
            <div class="card-body">
                @if($recentOrders->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($recentOrders as $order)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $order->client->name }}</strong><br>
                                    <small class="text-muted">{{ substr($order->description, 0, 40) }}...</small>
                                </div>
                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'danger' : 'warning') }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No orders yet</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <strong>System Statistics</strong>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h5>Total Measurements</h5>
                        <h3>{{ $totalMeasurements }}</h3>
                    </div>
                    <div class="col-md-4">
                        <h5>Orders Completion Rate</h5>
                        <h3>
                            @if($totalOrders > 0)
                                {{ round(($completedOrders / $totalOrders) * 100) }}%
                            @else
                                N/A
                            @endif
                        </h3>
                    </div>
                    <div class="col-md-4">
                        <h5>Avg Measurements per Client</h5>
                        <h3>
                            @if($totalClients > 0)
                                {{ round($totalMeasurements / $totalClients, 1) }}
                            @else
                                N/A
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-4">
    <a href="{{ route('clients.index') }}" class="btn btn-primary btn-lg">Go to Clients</a>
</div>
@endsection
