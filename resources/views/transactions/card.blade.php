<div class="card h-48">
        <div class="text-xl font-semibold py-4 -ml-5 mb-3 border-l-4 border-blue-300 pl-4">
            <a href="{{ $project->path() }}">
                {{ $project->title }}
            </a>
        </div>
        <div class="text-gray-400">{{ Str::limit($project->description) }}</div>
</div>
