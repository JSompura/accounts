<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_add_tasks_to_project(): void
    {
        $project = Project::factory()->create();
        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    public function test_only_owner_of_a_project_can_add_tasks(): void
    {
        $this->signIn();
        $project = Project::factory()->create();
        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' =>  'Test task']);
    }

    public function test_only_owner_of_a_project_can_update_a_task(): void
    {
        $this->signIn();
        $project = Project::factory()->create();
        $task = $project->addTask('Test task');
        $this->patch($task->path(), ['body' => 'changed'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' =>  'changed']);
    }

    public function test_a_project_can_have_tasks(): void
    {
        $this->signIn();
        $project = Auth::user()->projects()->create(
            Project::factory()->raw()
        );

        $this->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    public function test_a_task_can_be_updated(): void
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $project = Auth::user()->projects()->create(
            Project::factory()->raw()
        );
        $task = $project->addTask('test task');
        $this->patch($task->path(), [
            'body' => 'changed',
            'completed' => true,
        ]);
        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true,
        ]);
    }

    public function test_a_task_requires_a_body(): void
    {
        $this->signIn();
        $project = Auth::user()->projects()->create(
            Project::factory()->raw()
        );
        $attributes = Task::factory()->raw(['body' => '']);
        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
