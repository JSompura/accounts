@extends('layouts.app')
@section('content')

    {{-- <form method="POST" action="/projects" class="max-w-sm mx-auto">
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
    </form> --}}

    <div class="max-w-md mx-auto bg-white rounded p-6">
        <h1 class="text-2xl font-bold mb-6">Transaction Form</h1>

        <form method="post" action="/transactions" class="space-y-4">
            @csrf
            <div class="flex flex-col">
                <label for="date" class="text-sm font-medium text-gray-600">Date</label>
                <input type="date" id="date" name="date" class="p-2 border border-gray-300 rounded-md">
            </div>

            <div class="flex flex-col">
                <label for="account_id" class="text-sm font-medium text-gray-600">Account</label>
                <select id="account_id" name="account_id" class="p-2 border border-gray-300 rounded-md">
                @foreach ($accounts as $key => $name)
                    <option value={{ $key }}>{{ $name }}</option>
                @endforeach
                    {{-- <option value="cash">Cash</option>
                <option value="gpay">GPay</option>
                <option value="card">Card</option> --}}
                </select>
            </div>

            <div class="flex flex-col">
                <label for="category_id" class="text-sm font-medium text-gray-600">Category</label>
                <select id="category_id" name="category_id" class="p-2 border border-gray-300 rounded-md">
                @foreach ($categories as $key => $name)
                    <option value={{ $key }}>{{ $name }}</option>
                @endforeach
                {{-- <option value="health">Health</option>
                <option value="food">Food</option>
                <option value="household">Household</option>
                <option value="entertainment">Entertainment</option>
                <option value="other">Other</option> --}}
                </select>
            </div>

            <div class="flex flex-col">
                <label for="amount" class="text-sm font-medium text-gray-600">Amount (INR)</label>
                <input type="number" id="amount" name="amount" step="0.01" class="p-2 border border-gray-300 rounded-md">
            </div>

            <div class="flex flex-col">
                <label for="description" class="text-sm font-medium text-gray-600">Description</label>
                <textarea id="description" name="description" rows="3" class="p-2 border border-gray-300 rounded-md"></textarea>
            </div>

            <div class="flex justify-end">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                    Button
                </button>
            </div>
            </form>
        </div>
@endsection
