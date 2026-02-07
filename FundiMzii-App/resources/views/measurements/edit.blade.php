@extends('layout')

@section('title', 'Edit Measurement - FundiMzii')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1>Edit Measurement</h1>

        <form method="POST" action="{{ route('measurements.update', $measurement) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="measurement_date" class="form-label">Date of Measurement *</label>
                    <input type="date" class="form-control @error('measurement_date') is-invalid @enderror" 
                           id="measurement_date" name="measurement_date" value="{{ old('measurement_date', $measurement->measurement_date) }}" required>
                    @error('measurement_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="photo" class="form-label">Photo (Optional)</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                           id="photo" name="photo" accept="image/*">
                    @error('photo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-secondary text-white">
                    <strong>Body Measurements (in cm)</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="chest" class="form-label">Chest</label>
                            <input type="number" step="0.1" class="form-control" id="chest" name="chest" value="{{ old('chest', $measurement->chest) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="waist" class="form-label">Waist</label>
                            <input type="number" step="0.1" class="form-control" id="waist" name="waist" value="{{ old('waist', $measurement->waist) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hip" class="form-label">Hip</label>
                            <input type="number" step="0.1" class="form-control" id="hip" name="hip" value="{{ old('hip', $measurement->hip) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="length" class="form-label">Length</label>
                            <input type="number" step="0.1" class="form-control" id="length" name="length" value="{{ old('length', $measurement->length) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sleeve_length" class="form-label">Sleeve Length</label>
                            <input type="number" step="0.1" class="form-control" id="sleeve_length" name="sleeve_length" value="{{ old('sleeve_length', $measurement->sleeve_length) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="shoulder_width" class="form-label">Shoulder Width</label>
                            <input type="number" step="0.1" class="form-control" id="shoulder_width" name="shoulder_width" value="{{ old('shoulder_width', $measurement->shoulder_width) }}">
                        </div>
                        <div class="col-md-6 mb-0">
                            <label for="inseam" class="form-label">Inseam</label>
                            <input type="number" step="0.1" class="form-control" id="inseam" name="inseam" value="{{ old('inseam', $measurement->inseam) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $measurement->notes) }}</textarea>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('clients.show', $measurement->client) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Measurement</button>
            </div>
        </form>
    </div>
</div>
@endsection
