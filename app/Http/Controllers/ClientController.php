<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Measurement;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('measurements')->get();
        return view('fundimzii.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'measurement_date' => 'required|date',
            'chest' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
            'hips' => 'nullable|numeric',
            'shoulder' => 'nullable|numeric',
            'sleeve' => 'nullable|numeric',
            'inseam' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $client = Client::firstOrCreate([
            'phone' => $request->phone,
        ], [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        $measurement = new Measurement($request->only([
            'measurement_date', 'chest', 'waist', 'hips', 'shoulder', 'sleeve', 'inseam', 'notes'
        ]));
        $measurement->client_id = $client->id;

        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('measurements', 'public');
                $photos[] = $path;
            }
            $measurement->photos = $photos;
        }

        $measurement->save();

        return redirect()->back()->with('success', 'Client and measurement saved successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $clients = Client::where('name', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->orWhereHas('measurements', function ($q) use ($query) {
                $q->whereDate('measurement_date', $query);
            })
            ->with('measurements')
            ->get();

        return view('fundimzii.index', compact('clients'));
    }

    public function exportPdf($measurementId)
    {
        $measurement = Measurement::with('client')->findOrFail($measurementId);
        $pdf = Pdf::loadView('fundimzii.pdf', compact('measurement'));
        return $pdf->download('measurement_sheet.pdf');
    }

    public function reports()
    {
        $totalClients = Client::count();
        $pendingOrders = Measurement::where('measurement_date', '>', now())->count();
        $frequentMeasurements = Measurement::selectRaw('COUNT(*) as count, AVG(chest) as avg_chest')
            ->groupBy('client_id')
            ->orderBy('count', 'desc')
            ->first();

        return view('fundimzii.reports', compact('totalClients', 'pendingOrders', 'frequentMeasurements'));
    }
}
