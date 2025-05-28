@extends('layouts.dashboard')

@section('title', 'Edit Article')
@section('page-title', 'Edit New Article')

@section('content')
    <div class="mx-auto max-w-4xl">
        <!-- Breadcrumb -->
        <nav class="mb-6 flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('articles.index') }}"
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Articles</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">Article Information</h3>
                <p class="mt-1 text-sm text-gray-600">Fill in the details below to edit a new article.</p>
            </div>

            <form action="{{ route('articles.update', $article->slug) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 p-6">
                @csrf
                @method('PUT')
                <!-- Title -->
                <div>
                    <label for="title" class="mb-2 block text-sm font-medium text-gray-700">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}"
                        class="@error('title') border-red-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter article title" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">
                            @if ($message == 'The title has already been taken.')
                                This title is already in use. Please choose a different one.
                            @else
                                {{ $message }}
                            @endif
                        </p>
                    @enderror
                </div>
                <!-- Category and Status Row -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Category -->
                    <div>
                        <label for="category_id" class="mb-2 block text-sm font-medium text-gray-700">
                            Category <span class="text-red-500"></span>
                        </label>
                        <select id="category_id" name="category_id"
                            class="@error('category_id') border-red-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select a category</option>
                            @foreach ($categories ?? [] as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="mb-2 block text-sm font-medium text-gray-700">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status"
                            class="@error('status') border-red-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="published"
                                {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Featured Image -->
                <div>
                    <label for="featured_image" class="mb-2 block text-sm font-medium text-gray-700">
                        Featured Image
                    </label>
                    <div id="featured_image_wrapper"
                        class="aspect-w-16 aspect-h-9 relative mt-1 flex h-64 w-full items-center justify-center rounded-md border-2 border-dashed border-gray-300 bg-cover bg-center bg-no-repeat object-cover px-6 pb-6 pt-5 transition-colors hover:border-gray-400">
                        <div class="overlay"></div> <!-- Overlay hitam transparan -->
                        <div id="upload_content" class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48">
                                <path d=" M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0
                                                01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4
                                                4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="featured_image"
                                    class="relative cursor-pointer rounded-md font-medium text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:text-blue-500">
                                    <span>Upload a file</span>
                                    <input id="featured_image" name="featured_image" type="file" class="sr-only"
                                        accept="image/*">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                    @error('featured_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="mb-2 block text-sm font-medium text-gray-700">
                        Excerpt
                    </label>
                    <textarea id="excerpt" name="excerpt" rows="3"
                        class="@error('excerpt') border-red-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Brief description of the article...">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Optional short description for article previews</p>
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="mb-2 block text-sm font-medium text-gray-700">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content" rows="12"
                        class="@error('content') border-red-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Write your article content here..." required>{{ old('content', $article->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags -->
                <div>
                    <label for="tags" class="mb-2 block text-sm font-medium text-gray-700">
                        Tags
                    </label>
                    <input type="text" id="tags" name="tags" value="{{ old('tags') }}"
                        class="@error('tags') border-red-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="laravel, php, web development">
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Separate tags with commas</p>
                </div>

                <!-- Meta Description -->
                <div>
                    <label for="meta_description" class="mb-2 block text-sm font-medium text-gray-700">
                        Meta Description
                    </label>
                    <textarea id="meta_description" name="meta_description" rows="2"
                        class="@error('meta_description') border-red-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="SEO meta description...">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Recommended length: 150-160 characters</p>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                    <a href="{{ route('articles.index') }}"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18">
                            </path>
                        </svg>
                        Cancel
                    </a>

                    <div class="flex space-x-3">
                        <button type="submit" name="action" value="draft"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            Save as Draft
                        </button>

                        <button type="submit" name="action" value="publish"
                            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Publish Article
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('featured_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const wrapper = document.getElementById('featured_image_wrapper');
            const uploadContent = document.getElementById('upload_content');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    wrapper.style.backgroundImage = `url('${e.target.result}')`;
                };
                reader.readAsDataURL(file);
            } else {
                wrapper.style.backgroundImage = '';
                uploadContent.style.display = 'block';
            }
        });
    </script>
@endsection
