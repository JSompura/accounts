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
        $this->actingAs(User::factory()->create());
        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->paragraph(5)
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $attributes);
        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_a_user_can_view_a_project(): void
    {
        $this->be(User::factory()->create());
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get('/projects/'. $project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);

    }

    public function test_authenticated_user_cannot_view_the_projects_of_others(): void
    {
        $this->be(User::factory()->create());
        $this->actingAs(User::factory()->create());
        $project = Project::factory()->create();
        $this->get($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title(): void
    {
        $this->actingAs(User::factory()->create());
        $attributes = Project::factory()->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors();
    }

}