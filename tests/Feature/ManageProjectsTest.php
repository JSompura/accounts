<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_manage_projects(): void
    {
        $project = Project::factory()->create();
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

    public function test_a_user_can_create_a_project(): void
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(5),
            'notes' => 'General notes here.'
        ];

        $response = $this->post('/projects', $attributes);
        $project = Project::where($attributes)->first();
        $response->assertRedirect($project->path());
        $this->assertDatabaseHas('projects', $attributes);
        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    function test_a_user_can_update_a_project(): void
    {
        $this->signIn();
        $this->withoutExceptionHandling();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);
        $this->patch($project->path(), [
            'notes' => 'changed'
        ])->assertRedirect($project->path());
        $this->assertDatabaseHas('projects', ['notes' => 'changed']);
    }

    public function test_a_user_can_view_a_project(): void
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get('/projects/'. $project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);

    }

    public function test_authenticated_user_cannot_view_the_projects_of_others(): void
    {
        $this->signIn();
        $project = Project::factory()->create();
        $this->get($project->path())->assertStatus(403);
    }

    public function test_authenticated_user_cannot_update_the_projects_of_others(): void
    {
        $this->signIn();
        $project = Project::factory()->create();
        $this->patch($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title(): void
    {
        $this->signIn();
        $attributes = Project::factory()->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors();
    }

}
