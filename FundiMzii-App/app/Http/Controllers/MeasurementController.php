<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Measurement;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    public function create(Client $client)
    {
        return view('measurements.create', compact('client'));
    }

    public function store(Request $request, Client $client)
    {
        $validated = $request->validate([
            'chest' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
            'hip' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'sleeve_length' => 'nullable|numeric',
            'shoulder_width' => 'nullable|numeric',
            'inseam' => 'nullable|numeric',
            'measurement_date' => 'required|date',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('measurements', 'public');
            $validated['photo_path'] = $path;
        }

        $validated['client_id'] = $client->id;
        Measurement::create($validated);

        return redirect()->route('clients.show', $client)->with('success', 'Measurement recorded successfully!');
    }

    public function edit(Measurement $measurement)
    {
        return view('measurements.edit', compact('measurement'));
    }

    public function update(Request $request, Measurement $measurement)
    {
        $validated = $request->validate([
            'chest' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
            'hip' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'sleeve_length' => 'nullable|numeric',
            'shoulder_width' => 'nullable|numeric',
            'inseam' => 'nullable|numeric',
            'measurement_date' => 'required|date',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('measurements', 'public');
            $validated['photo_path'] = $path;
        }

        $measurement->update($validated);

        return redirect()->route('clients.show', $measurement->client)->with('success', 'Measurement updated successfully!');
    }

    public function delete(Measurement $measurement)
    {
        $client = $measurement->client;
        $measurement->delete();
        return redirect()->route('clients.show', $client)->with('success', 'Measurement deleted!');
    }
}
?>
