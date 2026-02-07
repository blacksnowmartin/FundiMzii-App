<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Client $client)
    {
        return view('orders.create', compact('client'));
    }

    public function store(Request $request, Client $client)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'order_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:order_date',
            'amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        $validated['client_id'] = $client->id;
        Order::create($validated);

        return redirect()->route('clients.show', $client)->with('success', 'Order created successfully!');
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'order_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:order_date',
            'amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        $order->update($validated);

        return redirect()->route('clients.show', $order->client)->with('success', 'Order updated successfully!');
    }

    public function delete(Order $order)
    {
        $client = $order->client;
        $order->delete();
        return redirect()->route('clients.show', $client)->with('success', 'Order deleted!');
    }
}
?>
