@extends('layouts.app')
@section('content')
<header class="flex item-center mb-3 py-4">
    <div class="flex justify-between items-end w-full">

            <h2 class="text-gray-400 text-normal">
                <a href="/projects" class="hover:underline">My Projects</a> / {{ $project->title }}
            </h2>
        <a href="/projects/create"><p class="button">New project</p></a>
    </div>
</header>
<main>
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3 mb-6">
            <div class="mb-8">
                <h2 class="text-gray-400 text-xl font-normal mb-3">Tasks</h2>

                @foreach($project->tasks as $task)
                    <div class="card mb-3">{{ $task->body }}</div>
                @endforeach
                <div class="card mb-3">
                    <form method="POST" action="{{ $project->path() . '/tasks' }}">
                        @csrf
                        <input placeholder="Add a new task..." class="w-full" name="body">
                    </form>
                </div>

            </div>
            <div>
                <h2 class="text-gray-400 text-xl font-normal mb-3">General notes</h2>
                <div class="card h-60">Lorem ipsum...</div>
            </div>
        </div>
        <div class="lg:w=1/4 px-3">
            @include('projects.card')
        </div>
    </div>
</main>

@endsection
