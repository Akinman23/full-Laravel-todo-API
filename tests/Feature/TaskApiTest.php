<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_tasks(): void
    {
        Task::factory()->count(3)->create();
        $this->getJson('/api/tasks')
             ->assertOk()
             ->assertJsonPath('success', true)
             ->assertJsonCount(3, 'data');
    }

    public function test_returns_empty_array_when_no_tasks(): void
    {
        $this->getJson('/api/tasks')
             ->assertOk()
             ->assertJsonPath('data', []);
    }

    public function test_can_create_task_with_all_fields(): void
    {
        $this->postJson('/api/tasks', [
            'title'       => 'Write tests',
            'description' => 'Cover all endpoints.',
            'status'      => 'in_progress',
        ])->assertCreated()
          ->assertJsonPath('data.title', 'Write tests')
          ->assertJsonPath('data.status', 'in_progress');
    }

    public function test_can_create_task_with_title_only(): void
    {
        $this->postJson('/api/tasks', ['title' => 'Minimal task'])
             ->assertCreated()
             ->assertJsonPath('data.status', 'pending');
    }

    public function test_cannot_create_task_without_title(): void
    {
        $this->postJson('/api/tasks', ['description' => 'No title'])
             ->assertUnprocessable()
             ->assertJsonStructure(['errors' => ['title']]);
    }

    public function test_cannot_create_task_with_invalid_status(): void
    {
        $this->postJson('/api/tasks', ['title' => 'Bad', 'status' => 'unknown'])
             ->assertUnprocessable()
             ->assertJsonStructure(['errors' => ['status']]);
    }

    public function test_can_get_single_task(): void
    {
        $task = Task::factory()->create(['title' => 'Find me']);
        $this->getJson("/api/tasks/{$task->id}")
             ->assertOk()
             ->assertJsonPath('data.title', 'Find me');
    }

    public function test_returns_404_for_missing_task(): void
    {
        $this->getJson('/api/tasks/9999')->assertNotFound();
    }

    public function test_can_update_task(): void
    {
        $task = Task::factory()->create(['status' => 'pending']);
        $this->putJson("/api/tasks/{$task->id}", ['status' => 'done'])
             ->assertOk()
             ->assertJsonPath('data.status', 'done');
    }

    public function test_cannot_update_task_title_to_empty(): void
    {
        $task = Task::factory()->create();
        $this->putJson("/api/tasks/{$task->id}", ['title' => ''])
             ->assertUnprocessable()
             ->assertJsonStructure(['errors' => ['title']]);
    }

    public function test_can_delete_task(): void
    {
        $task = Task::factory()->create();
        $this->deleteJson("/api/tasks/{$task->id}")->assertOk();
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_returns_404_when_deleting_missing_task(): void
    {
        $this->deleteJson('/api/tasks/9999')->assertNotFound();
    }
}
