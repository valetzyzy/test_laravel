<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to get all clients.
     *
     * @return void
     */
    public function testGetAllClients()
    {
        $this->seed(\ClientSeeder::class);

        $response = $this->json('GET', '/api/client');
        $response->assertStatus(200)
            ->assertJsonCount(50, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'first_name',
                        'last_name',
                        'email',
                        'created_at',
                    ]
                ]
            ]);
    }

    public function testCreateClient()
    {
        $response = $this->json('POST', '/api/client', [
            'first_name' => 'Testname',
            'last_name' => 'Testlastname',
            'email' => 'test@test.com',
            'password' => 'password'
        ]);

        $response->assertStatus(201)
            ->assertJsonCount(1)
            ->assertJsonStructure([
                'data' => [
                    'first_name',
                    'last_name',
                    'email',
                    'created_at',
                ]
            ]);
    }

    public function testGetSpecificClient()
    {
        $this->seed(\ClientSeeder::class);

        $response = $this->json('GET', '/api/client/1');
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonStructure([
                'data' => [
                    'first_name',
                    'last_name',
                    'email',
                    'created_at',
                ]
            ]);
    }

    public function testUpdateClient()
    {
        $this->seed(\ClientSeeder::class);

        $response = $this->json('PUT', '/api/client/1', [
            'first_name' => 'Changed',
            'last_name' => 'Changed',
            'email' => 'changedEMail@test.com'
        ]);
        $response->assertStatus(200)
            ->assertJsonFragment([
                'first_name' => 'Changed',
                'last_name' => 'Changed',
                'email' => 'changedEMail@test.com'
            ]);
    }

    public function testDeleteClient()
    {
        $this->seed(\ClientSeeder::class);

        $response = $this->json('DELETE', '/api/client/1');
        $response->assertStatus(200);

        $response = $this->json('DELETE', '/api/client/1');
        $response->assertStatus(200);
    }

    public function testNotFoundClient()
    {
        $this->seed(\ClientSeeder::class);

        $response = $this->json('GET', '/api/client/notExistingNumber');
        $response->assertStatus(404);
    }



    public function testValidationError()
    {
        $response = $this->json('POST', '/api/client', [
            'first_name' => 'Testname',
            'last_name' => 'Testlastname',
            'email' => 'test@test.com',
        ]);

        $response->assertStatus(400);
    }
}
