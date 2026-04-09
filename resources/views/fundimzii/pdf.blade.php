<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Measurement Sheet</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111827; margin: 0; padding: 32px; }
        .header { text-align: center; margin-bottom: 24px; }
        .header h1 { font-size: 32px; margin-bottom: 6px; }
        .header p { color: #475569; margin: 0; }
        .section { margin-bottom: 22px; }
        .section h3 { margin-bottom: 12px; color: #1f2937; }
        .details { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
        .details p { margin: 0; line-height: 1.6; }
        .details strong { color: #0f172a; }
        .measurements { width: 100%; border-collapse: collapse; margin-top: 12px; }
        .measurements th,
        .measurements td { border: 1px solid #cbd5e1; padding: 12px; text-align: left; }
        .measurements th { background: #eef2ff; color: #1e293b; }
        .notes { background: #f8fafc; border-left: 5px solid #6366f1; padding: 12px 14px; border-radius: 12px; }
        .photos { margin-top: 20px; }
        .photo { max-width: 190px; display: inline-block; margin: 8px 8px 0 0; border-radius: 12px; border: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>FundiMzii Measurement Sheet</h1>
        <p>Detailed client measurement summary for tailoring and order tracking.</p>
    </div>

    <div class="section">
        <h3>Client Information</h3>
        <div class="details">
            <p><strong>Name:</strong> {{ $measurement->client->name }}</p>
            <p><strong>Phone:</strong> {{ $measurement->client->phone }}</p>
            <p><strong>Email:</strong> {{ $measurement->client->email ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $measurement->measurement_date->format('Y-m-d') }}</p>
            <p><strong>Address:</strong> {{ $measurement->client->address ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="section">
        <h3>Measurements</h3>
        <table class="measurements">
            <tr>
                <th>Chest</th>
                <td>{{ $measurement->chest ? $measurement->chest . ' cm' : '—' }}</td>
            </tr>
            <tr>
                <th>Waist</th>
                <td>{{ $measurement->waist ? $measurement->waist . ' cm' : '—' }}</td>
            </tr>
            <tr>
                <th>Hips</th>
                <td>{{ $measurement->hips ? $measurement->hips . ' cm' : '—' }}</td>
            </tr>
            <tr>
                <th>Shoulder</th>
                <td>{{ $measurement->shoulder ? $measurement->shoulder . ' cm' : '—' }}</td>
            </tr>
            <tr>
                <th>Sleeve</th>
                <td>{{ $measurement->sleeve ? $measurement->sleeve . ' cm' : '—' }}</td>
            </tr>
            <tr>
                <th>Inseam</th>
                <td>{{ $measurement->inseam ? $measurement->inseam . ' cm' : '—' }}</td>
            </tr>
        </table>
    </div>

    @if($measurement->notes)
        <div class="section notes">
            <h3>Notes</h3>
            <p>{{ $measurement->notes }}</p>
        </div>
    @endif

    @if($measurement->photos)
        <div class="section photos">
            <h3>Reference Photos</h3>
            @foreach($measurement->photos as $photo)
                <img src="{{ asset('storage/' . $photo) }}" class="photo" alt="Reference Photo">
            @endforeach
        </div>
    @endif
</body>
</html>