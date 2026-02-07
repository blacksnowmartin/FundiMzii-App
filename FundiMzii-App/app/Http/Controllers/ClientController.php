<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Measurement;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('measurements', 'orders')->paginate(20);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:clients',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        Client::create($validated);
        return redirect()->route('clients.index')->with('success', 'Client created successfully!');
    }

    public function show(Client $client)
    {
        $measurements = $client->measurements()->latest()->get();
        $orders = $client->orders()->latest()->get();
        return view('clients.show', compact('client', 'measurements', 'orders'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $client->update($validated);
        return redirect()->route('clients.show', $client)->with('success', 'Client updated successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $clients = Client::where('name', 'like', "%{$query}%")
            ->orWhere('phone_number', 'like', "%{$query}%")
            ->with('measurements', 'orders')
            ->get();

        return view('clients.search', compact('clients', 'query'));
    }
}
?>
