<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Measurement;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function dashboard()
    {
        $totalClients = Client::count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $totalMeasurements = Measurement::count();

        $frequentMeasurements = DB::table('measurements')
            ->select(DB::raw('COUNT(*) as count, MONTH(measurement_date) as month'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $recentClients = Client::latest()->take(5)->get();
        $recentOrders = Order::with('client')->latest()->take(10)->get();

        return view('reports.dashboard', compact(
            'totalClients',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalMeasurements',
            'frequentMeasurements',
            'recentClients',
            'recentOrders'
        ));
    }

    public function exportPdf(Client $client)
    {
        $measurements = $client->measurements()->latest()->latest()->get();
        
        $html = '<h1>' . $client->name . '\'s Measurements</h1>';
        $html .= '<p><strong>Phone:</strong> ' . $client->phone_number . '</p>';
        $html .= '<p><strong>Email:</strong> ' . ($client->email ?? 'N/A') . '</p>';
        $html .= '<p><strong>Address:</strong> ' . ($client->address ?? 'N/A') . '</p>';
        
        $html .= '<h2>Measurements History</h2>';
        $html .= '<table border="1" style="width:100%; border-collapse:collapse;">';
        $html .= '<tr><th>Date</th><th>Chest</th><th>Waist</th><th>Hip</th><th>Length</th><th>Sleeve</th><th>Shoulder</th><th>Inseam</th><th>Notes</th></tr>';
        
        foreach ($measurements as $m) {
            $html .= '<tr>';
            $html .= '<td>' . $m->measurement_date . '</td>';
            $html .= '<td>' . ($m->chest ?? '-') . '</td>';
            $html .= '<td>' . ($m->waist ?? '-') . '</td>';
            $html .= '<td>' . ($m->hip ?? '-') . '</td>';
            $html .= '<td>' . ($m->length ?? '-') . '</td>';
            $html .= '<td>' . ($m->sleeve_length ?? '-') . '</td>';
            $html .= '<td>' . ($m->shoulder_width ?? '-') . '</td>';
            $html .= '<td>' . ($m->inseam ?? '-') . '</td>';
            $html .= '<td>' . substr($m->notes ?? '', 0, 50) . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</table>';

        $pdf = Pdf::loadHTML($html);
        return $pdf->download($client->name . '_measurements.pdf');
    }
}
?>
