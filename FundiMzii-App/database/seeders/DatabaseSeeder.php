<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Measurement;
use App\Models\Order;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample clients
        $clients = [
            [
                'name' => 'James Omondi',
                'phone_number' => '254712345678',
                'email' => 'james@example.com',
                'address' => 'Kariobangi North Market, Stall 42',
                'notes' => 'Prefers cotton fabrics'
            ],
            [
                'name' => 'Maria Kipchoge',
                'phone_number' => '254723456789',
                'email' => 'maria@example.com',
                'address' => 'Kariobangi North Market, Stall 15',
                'notes' => 'Regular customer, bulk orders'
            ],
            [
                'name' => 'Peter Kariuki',
                'phone_number' => '254734567890',
                'email' => null,
                'address' => 'Eastleigh Commercial, Shop 5',
                'notes' => 'Specializes in suits'
            ],
        ];

        foreach ($clients as $clientData) {
            $client = Client::create($clientData);

            // Add sample measurements
            Measurement::create([
                'client_id' => $client->id,
                'chest' => 92.5,
                'waist' => 78.0,
                'hip' => 95.0,
                'length' => 45.0,
                'sleeve_length' => 58.0,
                'shoulder_width' => 42.0,
                'inseam' => 72.0,
                'measurement_date' => Carbon::now()->subMonths(2),
                'notes' => 'Initial measurement'
            ]);

            Measurement::create([
                'client_id' => $client->id,
                'chest' => 93.0,
                'waist' => 78.5,
                'hip' => 95.5,
                'length' => 45.0,
                'sleeve_length' => 58.5,
                'shoulder_width' => 42.5,
                'inseam' => 72.0,
                'measurement_date' => Carbon::now(),
                'notes' => 'Follow-up measurement'
            ]);

            // Add sample orders
            Order::create([
                'client_id' => $client->id,
                'description' => 'Men\'s three-piece suit (jacket, trousers, waistcoat)',
                'status' => 'completed',
                'order_date' => Carbon::now()->subMonths(1),
                'due_date' => Carbon::now()->subDays(15),
                'amount' => 8500.00,
                'notes' => 'Premium fabric, completed on time'
            ]);

            Order::create([
                'client_id' => $client->id,
                'description' => 'Ladies\' traditional dress',
                'status' => 'in_progress',
                'order_date' => Carbon::now()->subDays(10),
                'due_date' => Carbon::now()->addDays(5),
                'amount' => 3500.00,
                'notes' => 'Ready for fitting'
            ]);

            Order::create([
                'client_id' => $client->id,
                'description' => 'Shirt tailoring and hemming',
                'status' => 'pending',
                'order_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDays(3),
                'amount' => 500.00,
                'notes' => 'Simple alterations'
            ]);
        }

        echo "Sample data seeded successfully!\n";
    }
}
?>
