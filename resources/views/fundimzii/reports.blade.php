@extends('layouts.app')

@section('title', 'FundiMzii - Reports')

@section('content')
    <div class="page-header text-center">
        <span class="eyebrow">Performance at a glance</span>
        <h1>Reports</h1>
        <p class="lead">Track total clients, pending work, and measurement trends in one polished dashboard.</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="card-body text-center">
                    <div class="stat-label">Total Clients</div>
                    <div class="stat-value">{{ $totalClients }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="card-body text-center">
                    <div class="stat-label">Pending Orders</div>
                    <div class="stat-value">{{ $pendingOrders }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="card-body text-center">
                    <div class="stat-label">Avg Chest Measurement</div>
                    <div class="stat-value">{{ $frequentMeasurements ? number_format($frequentMeasurements->avg_chest, 2) : 'N/A' }} cm</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-modern">
        <div class="card-body text-center">
            <h2 class="h5 mb-3">Insights</h2>
            <p class="small-note mb-0">Use these metrics to prioritize follow-up orders and keep the tailor workflow organized.</p>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-brand btn-lg">Back to Home</a>
    </div>
@endsection