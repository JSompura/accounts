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
                <div class="card mb-3">
                    <form method="POST" action="{{ $task->path() }}">
                        @method('patch')
                        @csrf
                        <div class="flex items-center">
                            <input value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-400' : '' }}" name="body">
                            <input name="completed" class="rounded-sm" type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        </div>
                    </form>
                </div>
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
                <form method="POST" action="{{ $project->path() }}">
                    @csrf
                    @method('PATCH')
                    <textarea
                        name="notes"
                        class="card h-60 w-full mb-4"
                        placeholder="Anything regarding this project to make a note of?"
                    >{{ $project->notes }}</textarea>
                    <button type="submit" class="button">Save</button>
                </form>
            </div>
        </div>
        <div class="lg:w=1/4 px-3">
            @include('projects.card')
        </div>
    </div>
</main>

@endsection
