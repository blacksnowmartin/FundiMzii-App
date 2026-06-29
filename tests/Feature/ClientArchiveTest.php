<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientArchiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_client_can_be_archived_and_restored(): void
    {
        $client = Client::create([
            'name' => 'Amina Tailor',
            'phone' => '0771234567',
            'email' => 'amina@example.com',
            'address' => 'Kigali',
        ]);

        $this->patch(route('clients.archive', $client))
            ->assertRedirect();

        $this->assertNotNull($client->fresh()->archived_at);

        $this->patch(route('clients.restore', $client))
            ->assertRedirect();

        $this->assertNull($client->fresh()->archived_at);
    }
}
