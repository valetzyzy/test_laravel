<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;


    public function testGetAllProjects()
    {
        $this->seed(\ProjectSeeder::class);

        $response = $this->json('GET', '/api/project');
        $response->assertStatus(200)
            ->assertJsonCount(50, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'name',
                        'description',
                        'status',
                        'created_at',
                    ]
                ]
            ]);
    }

    public function testCreateProject()
    {
        $response = $this->json('POST', '/api/project', [
            'name' => 'Testname',
            'description' => 'Test description',
            'status' => 1
        ]);

        $response->assertStatus(201)
            ->assertJsonCount(1)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'description',
                    'status',
                    'created_at',
                ]
            ]);
    }

    public function testGetSpecificProject()
    {
        $this->seed(\ProjectSeeder::class);

        $response = $this->json('GET', '/api/project/1');
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'description',
                    'status',
                    'created_at',
                ]
            ]);
    }

    public function testUpdateProject()
    {
        $this->seed(\ProjectSeeder::class);

        $response = $this->json('PUT', '/api/project/1', [
            'name' => 'Changed',
            'description' => 'Changed',
            'status' => 2
        ]);
        $response->dump();

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Changed',
                'description' => 'Changed',
                'status' => Project::STATUSES[2]
            ]);
    }

    public function testDeleteProject()
    {
        $this->seed(\ProjectSeeder::class);

        $response = $this->json('DELETE', '/api/project/1');
        $response->assertStatus(200);

        $response = $this->json('DELETE', '/api/project/1');
        $response->assertStatus(200);
    }

    public function testNotFoundProject()
    {
        $response = $this->json('GET', '/api/project/notExistingNumber');
        $response->assertStatus(404);
    }

    public function testValidationError()
    {
        $response = $this->json('POST', '/api/project', [
            'name' => 'Testname',
            'description' => 'Test description',
        ]);

        $response->assertStatus(400);
    }
}
