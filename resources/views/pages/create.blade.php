@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container mx-auto p-8">
        <div class="bg-green-500 text-white p-4">
            {{ session('success') }}
        </div>

        <h1 class="text-2xl font-semibold mb-4">Create a New Post</h1>

        <!-- Form -->
        <form action=" {{ route('posts.store') }}" method="post" enctype="multipart/form-data">

            @csrf
            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium">Title</label>
                <input type="text" id="title" name="title"
                    class="mt-1 p-2 w-full bg-gray-800 text-white rounded-md shadow-sm focus:outline-none focus:border-blue-300" value="{{ old('title') }}">
                     @error('title')
                        <p class="text-red-500"></p>
                     {{ $message }}
                   @enderror
            </div>

            <!-- Description Field -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium">Description</label>
                <textarea id="description" name="description"
                    class="mt-1 p-2 w-full h-32 bg-gray-800 text-white rounded-md shadow-sm focus:outline-none focus:border-blue-300">{{ old('description') }}</textarea>
                   @error('description')
                        <p class="text-red-500"></p>
                        {{ $message }}
                    @enderror
            </div>

            <!-- Category Field -->
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium">Category</label>
                <select id="category" name="category"
                    class="mt-1 p-2 w-full bg-gray-800 text-white rounded-md shadow-sm focus:outline-none focus:border-blue-300">
                    <option value="{{old('technology','technology')}}" >Technology</option>
                    <option value="{{old('lifestyle','lifestyle')}}" >Lifestyle</option>
                    <option value="{{old('travel','travel')}}" >Travel</option>
                    <option value="{{old('fashion','fashion')}}" >Fashion</option>
                    {{-- {{ old('category') == 'technology' ? 'selected' : '' }}
                    {{ old('category') == 'lifestyle' ? 'selected' : '' }}
                    {{ old('category') == 'travel' ? 'selected' : '' }}
                    {{ old('category') == 'fashion' ? 'selected' : '' }} --}}
                </select>
                 @error('category')
                <p class="text-red-500"></p>
                {{ $message }}
            @enderror
            </div>

            <!-- Tags Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium">Tags</label>
                <div class="flex flex-wrap">
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" class="form-checkbox text-blue-500" name="tags[]" value="{{old('PHP','PHP')}}" >

                        {{-- {{ in_array('PHP', old('tags', [])) ? 'checked' : '' }} --}}

                        <span class="ml-2">PHP</span>
                    </label>

                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" class="form-checkbox text-blue-500" name="tags[]" value="{{old('JS','JS')}}" >
                       {{-- {{in_array('JS', old('tags', [])) ? 'checked' : '' }} --}}
                        <span class="ml-2">JS</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" class="form-checkbox text-blue-500" name="tags[]" value="{{old('Python','Python')}}" >
                        {{-- {{ in_array('Python', old('tags', [])) ? 'checked' : '' }} --}}
                        <span class="ml-2">Python</span>
                    </label>
                </div>
               @error('tags')
                <p class="text-red-500"></p>
                {{ $message }}
            @enderror
            </div>

             <!-- Published/Draft Field -->
             <div class="mb-4">
                <label class="block text-sm font-medium">Status</label>
                <div class="flex">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio text-blue-500" name="status" value="{{old('published','published')}}" >
                        {{-- {{ old('status') == 'published' ? 'checked' : '' }} --}}
                        <span class="ml-2">Published</span>
                    </label>
                    <label class="ml-4 inline-flex items-center">
                        <input type="radio" class="form-radio text-blue-500" name="status" value="{{old('draft','draft')}}">
                        {{-- {{ old('status') == 'draft' ? 'checked' : '' }} --}}
                        <span class="ml-2">Draft</span>
                    </label>
                </div>

               @error('status')
                <p class="text-red-500"></p>
               {{ $message }}
            @enderror
            </div>

            <!-- Featured Image Field -->
            <div class="mb-4">
                <img id="featuredImageDisplay" alt="Featured Image" class="w-64 hidden">
                <label for="featuredImage" class="block text-sm font-medium">Featured Image</label>
                <input type="file" id="featuredImage" name="featured_image"
                    class="mt-1 p-2 w-full bg-gray-800 text-white rounded-md shadow-sm focus:outline-none focus:border-blue-300">
                   @error('featured_image')
                    <p class="text-red-500"></p>
                    {{ $message }}
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                Create Post
            </button>
        </form>
    </div
@endsection
