@extends('layout')

@section('title', 'New Measurement - FundiMzii')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1>Record Measurement for {{ $client->name }}</h1>

        <form method="POST" action="{{ route('measurements.store', $client) }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="measurement_date" class="form-label">Date of Measurement *</label>
                    <input type="date" class="form-control @error('measurement_date') is-invalid @enderror" 
                           id="measurement_date" name="measurement_date" value="{{ old('measurement_date', date('Y-m-d')) }}" required>
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
                            <input type="number" step="0.1" class="form-control @error('chest') is-invalid @enderror" 
                                   id="chest" name="chest" value="{{ old('chest') }}">
                            @error('chest') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="waist" class="form-label">Waist</label>
                            <input type="number" step="0.1" class="form-control @error('waist') is-invalid @enderror" 
                                   id="waist" name="waist" value="{{ old('waist') }}">
                            @error('waist') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="hip" class="form-label">Hip</label>
                            <input type="number" step="0.1" class="form-control @error('hip') is-invalid @enderror" 
                                   id="hip" name="hip" value="{{ old('hip') }}">
                            @error('hip') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="length" class="form-label">Length</label>
                            <input type="number" step="0.1" class="form-control @error('length') is-invalid @enderror" 
                                   id="length" name="length" value="{{ old('length') }}">
                            @error('length') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="sleeve_length" class="form-label">Sleeve Length</label>
                            <input type="number" step="0.1" class="form-control @error('sleeve_length') is-invalid @enderror" 
                                   id="sleeve_length" name="sleeve_length" value="{{ old('sleeve_length') }}">
                            @error('sleeve_length') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="shoulder_width" class="form-label">Shoulder Width</label>
                            <input type="number" step="0.1" class="form-control @error('shoulder_width') is-invalid @enderror" 
                                   id="shoulder_width" name="shoulder_width" value="{{ old('shoulder_width') }}">
                            @error('shoulder_width') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-0">
                            <label for="inseam" class="form-label">Inseam</label>
                            <input type="number" step="0.1" class="form-control @error('inseam') is-invalid @enderror" 
                                   id="inseam" name="inseam" value="{{ old('inseam') }}">
                            @error('inseam') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" 
                          id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                @error('notes') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('clients.show', $client) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Record Measurement</button>
            </div>
        </form>
    </div>
</div>
@endsection
