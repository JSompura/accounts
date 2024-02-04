<?php
namespace Tests\Setup;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Faker\Factory;

class ProjectFactory
{
    protected $taskCount = 0;

    function withTasks($count)
    {
        $this->taskCount = $count;
    }

    public function create() {
        $project = Project::factory()->create([
            'owner_id' => user::factory()
        ]);

        Task::factory()->count($this->taskCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}
