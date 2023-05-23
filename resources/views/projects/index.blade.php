@extends('layouts.app')
@section('content')

<div class="flex content-center mb-4">
    <img src="/images/logo.svg" alt="birdboard">
    <a href="/projects/create"><p class="underline">New project</p></a>
</div>
    <div class="flex flex-wrap -mx-3">
        @forelse ($projects as $project)
        <div class="w-1/3 px-3 py-6">
            <div class="bg-white p-5 rounded shadow h-48">
                    <div class="text-xl font-semibold py-4">{{ $project->title }}</div>
                    <div class="text-gray-400">{{ Str::limit($project->description) }}</div>
            </div>
        </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </div>
@endsection
