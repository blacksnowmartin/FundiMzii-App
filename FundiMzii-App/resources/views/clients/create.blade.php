@extends('layout')

@section('title', 'Quick Capture - FundiMzii')

@section('content')
<div class="hero-panel mb-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center">
        <div>
            <p class="section-kicker mb-2">Quick Capture | Sajili Haraka</p>
            <h1 class="mb-2">One-page client registration and measurement entry</h1>
            <p class="mb-0 text-muted">Register a client, save measurements, attach a reference photo, and optionally log an order from one touch-friendly page.</p>
        </div>
        <div class="hero-chip-group">
            <span class="hero-chip">English + Kiswahili</span>
            <span class="hero-chip">Offline-ready</span>
            <span class="hero-chip">XAMPP + MySQL</span>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data" data-offline-form>
    @csrf

    <div class="row g-4">
        <div class="col-12 col-xl-5">
            <div class="app-card h-100">
                <div class="app-card-header">
                    <h2>Client Details</h2>
                    <p>Maelezo ya mteja</p>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name <span class="text-muted">| Jina kamili</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number <span class="text-muted">| Namba ya simu</span></label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                        id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="07..." required>
                    @error('phone_number') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-muted">| Barua pepe</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" name="email" value="{{ old('email') }}">
                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address <span class="text-muted">| Mahali</span></label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                        id="address" name="address" rows="2">{{ old('address') }}</textarea>
                    @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="mb-0">
                    <label for="notes" class="form-label">Client Notes <span class="text-muted">| Maelezo ya ziada</span></label>
                    <textarea class="form-control @error('notes') is-invalid @enderror"
                        id="notes" name="notes" rows="4" placeholder="Preferred fit, fabric choices, delivery reminders...">{{ old('notes') }}</textarea>
                    @error('notes') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-7">
            <div class="app-card h-100">
                <div class="app-card-header">
                    <h2>Measurements</h2>
                    <p>Vipimo vya nguo</p>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="measurement_date" class="form-label">Measurement Date <span class="text-muted">| Tarehe</span></label>
                        <input type="date" class="form-control @error('measurement_date') is-invalid @enderror"
                            id="measurement_date" name="measurement_date" value="{{ old('measurement_date', date('Y-m-d')) }}">
                        @error('measurement_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="photo" class="form-label">Reference Photo <span class="text-muted">| Picha ya mfano</span></label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                            id="photo" name="photo" accept="image/*">
                        @error('photo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="chest" class="form-label">Chest <span class="text-muted">| Kifua</span></label>
                        <input type="number" step="0.1" class="form-control @error('chest') is-invalid @enderror"
                            id="chest" name="chest" value="{{ old('chest') }}" placeholder="cm">
                        @error('chest') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="waist" class="form-label">Waist <span class="text-muted">| Kiuno</span></label>
                        <input type="number" step="0.1" class="form-control @error('waist') is-invalid @enderror"
                            id="waist" name="waist" value="{{ old('waist') }}" placeholder="cm">
                        @error('waist') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="hip" class="form-label">Hip <span class="text-muted">| Nyonga</span></label>
                        <input type="number" step="0.1" class="form-control @error('hip') is-invalid @enderror"
                            id="hip" name="hip" value="{{ old('hip') }}" placeholder="cm">
                        @error('hip') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="length" class="form-label">Length <span class="text-muted">| Urefu</span></label>
                        <input type="number" step="0.1" class="form-control @error('length') is-invalid @enderror"
                            id="length" name="length" value="{{ old('length') }}" placeholder="cm">
                        @error('length') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="sleeve_length" class="form-label">Sleeve Length <span class="text-muted">| Urefu wa mkono</span></label>
                        <input type="number" step="0.1" class="form-control @error('sleeve_length') is-invalid @enderror"
                            id="sleeve_length" name="sleeve_length" value="{{ old('sleeve_length') }}" placeholder="cm">
                        @error('sleeve_length') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="shoulder_width" class="form-label">Shoulder Width <span class="text-muted">| Upana wa bega</span></label>
                        <input type="number" step="0.1" class="form-control @error('shoulder_width') is-invalid @enderror"
                            id="shoulder_width" name="shoulder_width" value="{{ old('shoulder_width') }}" placeholder="cm">
                        @error('shoulder_width') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="inseam" class="form-label">Inseam <span class="text-muted">| Ndani ya mguu</span></label>
                        <input type="number" step="0.1" class="form-control @error('inseam') is-invalid @enderror"
                            id="inseam" name="inseam" value="{{ old('inseam') }}" placeholder="cm">
                        @error('inseam') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label for="measurement_notes" class="form-label">Measurement Notes <span class="text-muted">| Maelezo ya vipimo</span></label>
                        <textarea class="form-control @error('measurement_notes') is-invalid @enderror"
                            id="measurement_notes" name="measurement_notes" rows="3" placeholder="Style notes, fit adjustments, fabric reminders...">{{ old('measurement_notes') }}</textarea>
                        @error('measurement_notes') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="app-card">
                <div class="app-card-header">
                    <h2>Optional Order Entry</h2>
                    <p>Agizo la kazi</p>
                </div>

                <div class="row g-3">
                    <div class="col-lg-4">
                        <label for="order_description" class="form-label">Garment / Service <span class="text-muted">| Kazi</span></label>
                        <input type="text" class="form-control @error('order_description') is-invalid @enderror"
                            id="order_description" name="order_description" value="{{ old('order_description') }}" placeholder="School uniform, dress, repair...">
                        @error('order_description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-sm-6 col-lg-2">
                        <label for="order_status" class="form-label">Status</label>
                        <select class="form-select @error('order_status') is-invalid @enderror" id="order_status" name="order_status">
                            <option value="">Select</option>
                            <option value="pending" @selected(old('order_status') === 'pending')>Pending</option>
                            <option value="in_progress" @selected(old('order_status') === 'in_progress')>In Progress</option>
                            <option value="completed" @selected(old('order_status') === 'completed')>Completed</option>
                            <option value="cancelled" @selected(old('order_status') === 'cancelled')>Cancelled</option>
                        </select>
                        @error('order_status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-sm-6 col-lg-2">
                        <label for="order_date" class="form-label">Order Date</label>
                        <input type="date" class="form-control @error('order_date') is-invalid @enderror"
                            id="order_date" name="order_date" value="{{ old('order_date', date('Y-m-d')) }}">
                        @error('order_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-sm-6 col-lg-2">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control @error('due_date') is-invalid @enderror"
                            id="due_date" name="due_date" value="{{ old('due_date') }}">
                        @error('due_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-sm-6 col-lg-2">
                        <label for="amount" class="form-label">Amount (KES)</label>
                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                            id="amount" name="amount" value="{{ old('amount') }}" placeholder="0.00">
                        @error('amount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label for="order_notes" class="form-label">Order Notes <span class="text-muted">| Maelezo ya kazi</span></label>
                        <textarea class="form-control @error('order_notes') is-invalid @enderror"
                            id="order_notes" name="order_notes" rows="3">{{ old('order_notes') }}</textarea>
                        @error('order_notes') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-actions mt-4">
        <div class="d-grid d-md-flex gap-2 justify-content-md-end">
            <a href="{{ route('clients.index') }}" class="btn btn-light">View Clients</a>
            <button type="submit" class="btn btn-primary btn-save">Save Client Record</button>
        </div>
    </div>
</form>
@endsection
