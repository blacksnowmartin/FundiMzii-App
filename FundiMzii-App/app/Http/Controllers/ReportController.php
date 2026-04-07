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

        $frequentMeasurements = collect([
            ['label' => 'Chest', 'count' => Measurement::whereNotNull('chest')->count()],
            ['label' => 'Waist', 'count' => Measurement::whereNotNull('waist')->count()],
            ['label' => 'Hip', 'count' => Measurement::whereNotNull('hip')->count()],
            ['label' => 'Length', 'count' => Measurement::whereNotNull('length')->count()],
            ['label' => 'Sleeve', 'count' => Measurement::whereNotNull('sleeve_length')->count()],
            ['label' => 'Shoulder', 'count' => Measurement::whereNotNull('shoulder_width')->count()],
            ['label' => 'Inseam', 'count' => Measurement::whereNotNull('inseam')->count()],
        ])->sortByDesc('count')->take(4)->values();

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
        $measurements = $client->measurements()->latest('measurement_date')->get();

        $html = '<div style="font-family: DejaVu Sans, sans-serif; color: #122023;">';
        $html .= '<h1 style="margin-bottom: 0;">FundiMzii Measurement Sheet</h1>';
        $html .= '<p style="margin-top: 6px;">Client: <strong>' . e($client->name) . '</strong></p>';
        $html .= '<p><strong>Phone:</strong> ' . e($client->phone_number) . '<br>';
        $html .= '<strong>Email:</strong> ' . e($client->email ?? 'N/A') . '<br>';
        $html .= '<strong>Address:</strong> ' . e($client->address ?? 'N/A') . '</p>';
        $html .= '<h2 style="margin-top: 24px;">Measurement History</h2>';
        $html .= '<table border="1" cellpadding="8" style="width:100%; border-collapse:collapse; font-size: 12px;">';
        $html .= '<tr style="background:#f4ede3;"><th>Date</th><th>Chest</th><th>Waist</th><th>Hip</th><th>Length</th><th>Sleeve</th><th>Shoulder</th><th>Inseam</th><th>Notes</th></tr>';

        foreach ($measurements as $m) {
            $html .= '<tr>';
            $html .= '<td>' . e(optional($m->measurement_date)->format('d M Y')) . '</td>';
            $html .= '<td>' . e($m->chest ?? '-') . '</td>';
            $html .= '<td>' . e($m->waist ?? '-') . '</td>';
            $html .= '<td>' . e($m->hip ?? '-') . '</td>';
            $html .= '<td>' . e($m->length ?? '-') . '</td>';
            $html .= '<td>' . e($m->sleeve_length ?? '-') . '</td>';
            $html .= '<td>' . e($m->shoulder_width ?? '-') . '</td>';
            $html .= '<td>' . e($m->inseam ?? '-') . '</td>';
            $html .= '<td>' . e(str($m->notes ?? '')->limit(50)) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '</div>';

        $pdf = Pdf::loadHTML($html);
        return $pdf->download(str($client->name)->slug('_') . '_measurements.pdf');
    }
}
?>
