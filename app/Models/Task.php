<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $touches = ['project'];

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/$this->id";
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
