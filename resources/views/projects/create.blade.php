@extends('layouts.app')
@section('content')

</form>
    <form method="POST" action="/projects" class="max-w-sm mx-auto">
        @csrf
        <p class="font-sans text-4xl mb-5">Create a project</p>
        <div class="mb-4">
            <label class="block text-gray-700 text-lg font-bold mb-2" for="title"> Title </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Enter title">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-lg font-bold mb-2" for="description"> Description </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Enter description"></textarea>
        </div>

        <div class="flex items-center justify-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Submit
            </button>
            <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mx-5" type="button">
            <a href="/projects">Cancel</a>
        </button>
        </div>
    </form>
@endsection
