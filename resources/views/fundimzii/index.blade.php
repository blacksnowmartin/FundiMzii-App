@extends('layouts.app')

@section('title', 'FundiMzii - Client Measurements')

@section('content')
    <section class="page-header text-center">
        <span class="eyebrow">Tailor workflow simplified</span>
        <h1>FundiMzii</h1>
        <p class="lead">Register clients, capture measurements, attach reference photos, and export clean measurement sheets in seconds.</p>
    </section>

    @if(session('success'))
        <div class="alert alert-success rounded-4 shadow-sm border-0 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-modern mb-4">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
                <div>
                    <h2 class="h4 mb-1">Client & Measurement Entry</h2>
                    <p class="small-note mb-0">Enter client details and measurement values on one screen for fast data capture.</p>
                </div>
                <a href="{{ route('reports') }}" class="btn btn-outline-brand">View Reports</a>
            </div>

            <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="p-3 rounded-4" style="background: rgba(99,102,241,0.06);">
                            <h3 class="mb-3">Client Information</h3>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email (Optional)</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address (Optional)</label>
                                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-3 rounded-4" style="background: rgba(99,102,241,0.06);">
                            <h3 class="mb-3">Measurements</h3>
                            <div class="mb-3">
                                <label for="measurement_date" class="form-label">Measurement Date</label>
                                <input type="date" class="form-control" id="measurement_date" name="measurement_date" required>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label for="chest" class="form-label">Chest</label>
                                    <input type="number" step="0.01" class="form-control" id="chest" name="chest">
                                </div>
                                <div class="col-6">
                                    <label for="waist" class="form-label">Waist</label>
                                    <input type="number" step="0.01" class="form-control" id="waist" name="waist">
                                </div>
                                <div class="col-6">
                                    <label for="hips" class="form-label">Hips</label>
                                    <input type="number" step="0.01" class="form-control" id="hips" name="hips">
                                </div>
                                <div class="col-6">
                                    <label for="shoulder" class="form-label">Shoulder</label>
                                    <input type="number" step="0.01" class="form-control" id="shoulder" name="shoulder">
                                </div>
                                <div class="col-6">
                                    <label for="sleeve" class="form-label">Sleeve</label>
                                    <input type="number" step="0.01" class="form-control" id="sleeve" name="sleeve">
                                </div>
                                <div class="col-6">
                                    <label for="inseam" class="form-label">Inseam</label>
                                    <input type="number" step="0.01" class="form-control" id="inseam" name="inseam">
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="photos" class="form-label">Reference Photos</label>
                                <input type="file" class="form-control" id="photos" name="photos[]" multiple accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-brand btn-lg">Save Measurement</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card-modern">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
                <div>
                    <div class="accent-strip"></div>
                    <h2 class="h5 mb-2">Client Records</h2>
                    <p class="small-note mb-0">Search existing clients by name, phone, or a specific measurement date.</p>
                </div>
                <form action="{{ route('search') }}" method="GET" class="w-100 w-md-auto">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                        <input type="text" name="q" class="form-control border-0" placeholder="Search by name, phone, or date" value="{{ request('q') }}">
                        <button class="btn btn-brand px-4" type="submit">Search</button>
                    </div>
                </form>
            </div>

            @if($clients->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Measurements</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->measurements->count() }}</td>
                                    <td class="d-flex flex-wrap gap-2">
                                        @foreach($client->measurements as $measurement)
                                            <a href="{{ route('export.pdf', $measurement->id) }}" class="btn btn-sm btn-outline-brand">PDF</a>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0">No clients found. Use the form above to add your first client.</p>
            @endif
        </div>
    </div>
@endsection