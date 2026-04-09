<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FundiMzii - Tailor Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 10px; }
        .btn-primary { background-color: #007bff; border-color: #007bff; }
        .form-control { border-radius: 5px; }
        .measurement-input { width: 100%; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">FundiMzii - Client Measurements</h1>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('search') }}" method="GET" class="d-flex">
                    <input type="text" name="q" class="form-control me-2" placeholder="Search by name, phone, or date" value="{{ request('q') }}">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </form>
            </div>
        </div>

        <!-- Form -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">Add New Client & Measurement</h5>
                <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Client Information</h6>
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
                                <textarea class="form-control" id="address" name="address" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Measurements</h6>
                            <div class="mb-3">
                                <label for="measurement_date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="measurement_date" name="measurement_date" required>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="chest" class="form-label">Chest (Inches)</label>
                                    <input type="number" step="0.01" class="form-control measurement-input" id="chest" name="chest">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="waist" class="form-label">Waist (Inches)</label>
                                    <input type="number" step="0.01" class="form-control measurement-input" id="waist" name="waist">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="hips" class="form-label">Hips (Inches)</label>
                                    <input type="number" step="0.01" class="form-control measurement-input" id="hips" name="hips">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="shoulder" class="form-label">Shoulder (Inches)</label>
                                    <input type="number" step="0.01" class="form-control measurement-input" id="shoulder" name="shoulder">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="sleeve" class="form-label">Sleeve (Inches)</label>
                                    <input type="number" step="0.01" class="form-control measurement-input" id="sleeve" name="sleeve">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="inseam" class="form-label">Inseam (Inches)</label>
                                    <input type="number" step="0.01" class="form-control measurement-input" id="inseam" name="inseam">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="photos" class="form-label">Reference Photos</label>
                                <input type="file" class="form-control" id="photos" name="photos[]" multiple accept="image/*">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Measurement</button>
                </form>
            </div>
        </div>

        <!-- Clients List -->
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Clients & Measurements</h5>
                @if($clients->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                                        <td>
                                            @foreach($client->measurements as $measurement)
                                                <a href="{{ route('export.pdf', $measurement->id) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No clients found.</p>
                @endif
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('reports') }}" class="btn btn-info">View Reports</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>