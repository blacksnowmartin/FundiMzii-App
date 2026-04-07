@extends('layout')

@section('title', $client->name . ' - FundiMzii')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
    <div>
        <p class="section-kicker mb-2">Client Profile</p>
        <h1 class="mb-1">{{ $client->name }}</h1>
        <p class="text-muted mb-0">{{ $client->phone_number }} @if($client->email) | {{ $client->email }} @endif</p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-light">Edit Client</a>
        <a href="{{ route('measurements.create', $client) }}" class="btn btn-outline-primary">Add Measurement</a>
        <a href="{{ route('clients.export-pdf', $client) }}" class="btn btn-primary">Export PDF</a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="metric-card">
            <span>Total Measurements</span>
            <strong>{{ $measurements->count() }}</strong>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="metric-card">
            <span>Total Orders</span>
            <strong>{{ $orders->count() }}</strong>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="metric-card">
            <span>Latest Visit</span>
            <strong>{{ $latestMeasurement ? $latestMeasurement->measurement_date->format('d M Y') : 'None' }}</strong>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="metric-card">
            <span>Address</span>
            <strong>{{ $client->address ?: 'Not saved' }}</strong>
        </div>
    </div>
</div>

@if($latestMeasurement)
    <div class="app-card mb-4">
        <div class="app-card-header">
            <h2>Latest Measurement Snapshot</h2>
            <p>Most recent sizing summary</p>
        </div>
        <div class="row g-3">
            <div class="col-6 col-md-3"><div class="mini-stat">Chest <strong>{{ $latestMeasurement->chest ?? '-' }}</strong></div></div>
            <div class="col-6 col-md-3"><div class="mini-stat">Waist <strong>{{ $latestMeasurement->waist ?? '-' }}</strong></div></div>
            <div class="col-6 col-md-3"><div class="mini-stat">Hip <strong>{{ $latestMeasurement->hip ?? '-' }}</strong></div></div>
            <div class="col-6 col-md-3"><div class="mini-stat">Length <strong>{{ $latestMeasurement->length ?? '-' }}</strong></div></div>
            <div class="col-6 col-md-3"><div class="mini-stat">Sleeve <strong>{{ $latestMeasurement->sleeve_length ?? '-' }}</strong></div></div>
            <div class="col-6 col-md-3"><div class="mini-stat">Shoulder <strong>{{ $latestMeasurement->shoulder_width ?? '-' }}</strong></div></div>
            <div class="col-6 col-md-3"><div class="mini-stat">Inseam <strong>{{ $latestMeasurement->inseam ?? '-' }}</strong></div></div>
            <div class="col-6 col-md-3"><div class="mini-stat">Photo <strong>{{ $latestMeasurement->photo_path ? 'Saved' : 'None' }}</strong></div></div>
        </div>
        @if($latestMeasurement->notes)
            <div class="mt-3 text-muted">{{ $latestMeasurement->notes }}</div>
        @endif
    </div>
@endif

<div class="row g-4">
    <div class="col-xl-7">
        <div class="app-card h-100">
            <div class="app-card-header">
                <h2>Measurement History</h2>
                <p>Vipimo vilivyorekodiwa</p>
            </div>

            @if($measurements->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle app-table mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Chest</th>
                                <th>Waist</th>
                                <th>Hip</th>
                                <th>Length</th>
                                <th>Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($measurements as $m)
                                <tr>
                                    <td>{{ $m->measurement_date->format('d M Y') }}</td>
                                    <td>{{ $m->chest ?? '-' }}</td>
                                    <td>{{ $m->waist ?? '-' }}</td>
                                    <td>{{ $m->hip ?? '-' }}</td>
                                    <td>{{ $m->length ?? '-' }}</td>
                                    <td>{{ $m->photo_path ? 'Yes' : 'No' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0">No measurements recorded yet.</p>
            @endif
        </div>
    </div>

    <div class="col-xl-5">
        <div class="app-card h-100">
            <div class="app-card-header">
                <h2>Orders</h2>
                <p>Tracking pending work</p>
            </div>

            @if($orders->count() > 0)
                <div class="vstack gap-3">
                    @foreach($orders as $order)
                        <div class="order-tile">
                            <div class="d-flex justify-content-between gap-3">
                                <div>
                                    <strong>{{ $order->description }}</strong>
                                    <div class="text-muted small">Order date: {{ $order->order_date->format('d M Y') }}</div>
                                </div>
                                <span class="badge {{ $order->status === 'completed' ? 'text-bg-success' : ($order->status === 'pending' ? 'text-bg-warning' : 'text-bg-info') }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </div>
                            <div class="small text-muted mt-2">
                                Due: {{ $order->due_date ? $order->due_date->format('d M Y') : 'Not set' }}
                                @if($order->amount)
                                    | KES {{ number_format($order->amount, 2) }}
                                @endif
                            </div>
                            @if($order->notes)
                                <div class="small mt-2">{{ $order->notes }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">No orders recorded yet.</p>
            @endif
        </div>
    </div>
</div>

@if($client->notes)
    <div class="app-card mt-4">
        <div class="app-card-header">
            <h2>Client Notes</h2>
            <p>Extra reminders and preferences</p>
        </div>
        <p class="mb-0">{{ $client->notes }}</p>
    </div>
@endif
@endsection
