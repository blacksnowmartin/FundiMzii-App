<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Measurement Sheet</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .client-info { margin-bottom: 20px; }
        .measurements { width: 100%; border-collapse: collapse; }
        .measurements th, .measurements td { border: 1px solid #000; padding: 8px; text-align: left; }
        .photos { margin-top: 20px; }
        .photo { max-width: 200px; margin: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>FundiMzii - Measurement Sheet</h1>
    </div>

    <div class="client-info">
        <h3>Client Information</h3>
        <p><strong>Name:</strong> {{ $measurement->client->name }}</p>
        <p><strong>Phone:</strong> {{ $measurement->client->phone }}</p>
        <p><strong>Email:</strong> {{ $measurement->client->email ?? 'N/A' }}</p>
        <p><strong>Address:</strong> {{ $measurement->client->address ?? 'N/A' }}</p>
        <p><strong>Date:</strong> {{ $measurement->measurement_date->format('Y-m-d') }}</p>
    </div>

    <h3>Measurements</h3>
    <table class="measurements">
        <tr>
            <th>Chest</th>
            <td>{{ $measurement->chest }} cm</td>
        </tr>
        <tr>
            <th>Waist</th>
            <td>{{ $measurement->waist }} cm</td>
        </tr>
        <tr>
            <th>Hips</th>
            <td>{{ $measurement->hips }} cm</td>
        </tr>
        <tr>
            <th>Shoulder</th>
            <td>{{ $measurement->shoulder }} cm</td>
        </tr>
        <tr>
            <th>Sleeve</th>
            <td>{{ $measurement->sleeve }} cm</td>
        </tr>
        <tr>
            <th>Inseam</th>
            <td>{{ $measurement->inseam }} cm</td>
        </tr>
    </table>

    @if($measurement->notes)
        <h3>Notes</h3>
        <p>{{ $measurement->notes }}</p>
    @endif

    @if($measurement->photos)
        <div class="photos">
            <h3>Reference Photos</h3>
            @foreach($measurement->photos as $photo)
                <img src="{{ asset('storage/' . $photo) }}" class="photo" alt="Reference Photo">
            @endforeach
        </div>
    @endif
</body>
</html>