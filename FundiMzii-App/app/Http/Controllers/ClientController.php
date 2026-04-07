<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::withCount('measurements', 'orders')
            ->latest()
            ->paginate(20);

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
            'notes' => 'nullable|string',
            'measurement_date' => 'nullable|date',
            'chest' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
            'hip' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'sleeve_length' => 'nullable|numeric',
            'shoulder_width' => 'nullable|numeric',
            'inseam' => 'nullable|numeric',
            'measurement_notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'order_description' => 'nullable|string|max:255',
            'order_status' => 'nullable|in:pending,in_progress,completed,cancelled',
            'order_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:order_date',
            'amount' => 'nullable|numeric|min:0',
            'order_notes' => 'nullable|string',
        ]);

        $clientData = collect($validated)->only([
            'name',
            'phone_number',
            'email',
            'address',
            'notes',
        ])->toArray();

        $measurementData = collect($validated)->only([
            'measurement_date',
            'chest',
            'waist',
            'hip',
            'length',
            'sleeve_length',
            'shoulder_width',
            'inseam',
        ])->filter(static fn ($value) => $value !== null && $value !== '')->toArray();

        $measurementNotes = $validated['measurement_notes'] ?? null;
        if ($measurementNotes) {
            $measurementData['notes'] = $measurementNotes;
        }

        $orderData = collect($validated)->only([
            'order_description',
            'order_status',
            'order_date',
            'due_date',
            'amount',
        ])->filter(static fn ($value) => $value !== null && $value !== '')->toArray();

        $orderNotes = $validated['order_notes'] ?? null;
        if ($orderNotes) {
            $orderData['notes'] = $orderNotes;
        }

        $client = null;

        DB::transaction(function () use ($request, $clientData, $measurementData, $orderData, &$client) {
            $client = Client::create($clientData);

            if (!empty($measurementData)) {
                if ($request->hasFile('photo')) {
                    $measurementData['photo_path'] = $request->file('photo')->store('measurements', 'public');
                }

                $client->measurements()->create($measurementData);
            }

            if (!empty($orderData) && !empty($orderData['order_description']) && !empty($orderData['order_date'])) {
                $orderData['description'] = $orderData['order_description'];
                unset($orderData['order_description']);
                $orderData['status'] = $orderData['order_status'] ?? 'pending';
                unset($orderData['order_status']);
                $client->orders()->create($orderData);
            }
        });

        return redirect()
            ->route('clients.show', $client)
            ->with('success', 'Client profile, measurements, and order details saved successfully.');
    }

    public function show(Client $client)
    {
        $measurements = $client->measurements()->latest('measurement_date')->get();
        $orders = $client->orders()->latest()->get();
        $latestMeasurement = $client->measurements()->latest('measurement_date')->first();

        return view('clients.show', compact('client', 'measurements', 'orders', 'latestMeasurement'));
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
        $isDateSearch = preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) $query) === 1;

        $clients = Client::withCount('measurements', 'orders')
            ->where(function ($builder) use ($query, $isDateSearch) {
                $builder->where('name', 'like', "%{$query}%")
                    ->orWhere('phone_number', 'like', "%{$query}%");

                if ($isDateSearch) {
                    $builder->orWhereDate('created_at', $query)
                        ->orWhereHas('measurements', function ($measurementQuery) use ($query) {
                            $measurementQuery->whereDate('measurement_date', $query);
                        })
                        ->orWhereHas('orders', function ($orderQuery) use ($query) {
                            $orderQuery->whereDate('order_date', $query)
                                ->orWhereDate('due_date', $query);
                        });
                }
            })
            ->latest()
            ->get();

        return view('clients.search', compact('clients', 'query'));
    }
}
?>
