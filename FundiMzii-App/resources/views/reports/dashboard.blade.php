@extends('layout')

@section('title', 'Dashboard - FundiMzii')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
    <div>
        <p class="section-kicker mb-2">Business Snapshot</p>
        <h1 class="mb-1">Reports for daily tailoring work</h1>
        <p class="text-muted mb-0">Track client volume, pending work, and the measurements your shop records most often.</p>
    </div>
    <a href="{{ route('clients.create') }}" class="btn btn-primary">Capture New Client</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="metric-card">
            <span>Total Clients</span>
            <strong>{{ $totalClients }}</strong>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="metric-card">
            <span>Total Orders</span>
            <strong>{{ $totalOrders }}</strong>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="metric-card">
            <span>Pending Orders</span>
            <strong>{{ $pendingOrders }}</strong>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="metric-card">
            <span>Total Measurements</span>
            <strong>{{ $totalMeasurements }}</strong>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-6">
        <div class="app-card h-100">
            <div class="app-card-header">
                <h2>Recent Clients</h2>
                <p>Newest customer records</p>
            </div>

            @if($recentClients->count() > 0)
                <div class="vstack gap-3">
                    @foreach($recentClients as $client)
                        <div class="list-tile d-flex justify-content-between align-items-center gap-3">
                            <div>
                                <strong>{{ $client->name }}</strong>
                                <div class="text-muted small">{{ $client->phone_number }}</div>
                            </div>
                            <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-outline-primary">Open</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">No clients yet.</p>
            @endif
        </div>
    </div>

    <div class="col-xl-6">
        <div class="app-card h-100">
            <div class="app-card-header">
                <h2>Recent Orders</h2>
                <p>Work requiring attention</p>
            </div>

            @if($recentOrders->count() > 0)
                <div class="vstack gap-3">
                    @foreach($recentOrders as $order)
                        <div class="order-tile">
                            <div class="d-flex justify-content-between gap-3">
                                <div>
                                    <strong>{{ $order->client->name }}</strong>
                                    <div class="text-muted small">{{ $order->description }}</div>
                                </div>
                                <span class="badge {{ $order->status === 'completed' ? 'text-bg-success' : ($order->status === 'pending' ? 'text-bg-warning' : 'text-bg-info') }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">No orders yet.</p>
            @endif
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-xl-6">
        <div class="app-card h-100">
            <div class="app-card-header">
                <h2>Completion Snapshot</h2>
                <p>Orders completed versus all orders</p>
            </div>
            <div class="progress soft-progress mb-3" role="progressbar" aria-label="Completion rate">
                <div class="progress-bar" style="width: {{ $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100) : 0 }}%"></div>
            </div>
            <strong>
                @if($totalOrders > 0)
                    {{ round(($completedOrders / $totalOrders) * 100) }}% complete
                @else
                    No orders recorded yet
                @endif
            </strong>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="app-card h-100">
            <div class="app-card-header">
                <h2>Frequently Requested Measurements</h2>
                <p>Most commonly filled fields</p>
            </div>

            @if($frequentMeasurements->count() > 0)
                <div class="vstack gap-3">
                    @foreach($frequentMeasurements as $metric)
                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <span>{{ $metric['label'] }}</span>
                                <strong>{{ $metric['count'] }}</strong>
                            </div>
                            <div class="progress soft-progress">
                                <div class="progress-bar" style="width: {{ $totalMeasurements > 0 ? round(($metric['count'] / $totalMeasurements) * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">No measurement statistics yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
