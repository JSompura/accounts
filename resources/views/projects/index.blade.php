@extends('layouts.app')
@section('content')

<header class="flex item-center mb-3 py-4">
    <div class="flex justify-between items-end w-full">
        <h2 class="text-gray-400 text-lg">My Projects</h2>
        <a href="/projects/create"><p class="button">New project</p></a>
    </div>
</header>
    <div class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 py-6">
                @include('projects.card')
            </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </div>
@endsection
