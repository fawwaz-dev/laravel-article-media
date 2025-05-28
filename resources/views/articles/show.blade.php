@extends('layouts.dashboard')

@section('title', $article->title ?? 'Article Details')
@section('page-title', 'Article Details')

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
                        <span
                            class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($article->title ?? 'Article', 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Action Buttons -->
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <!-- Status Badge -->
                @if (isset($article->status))
                    @php
                        $statusColors = [
                            'published' => 'bg-green-100 text-green-800',
                            'draft' => 'bg-yellow-100 text-yellow-800',
                            'archived' => 'bg-gray-100 text-gray-800',
                        ];
                    @endphp
                    <span
                        class="{{ $statusColors[$article->status] ?? 'bg-gray-100 text-gray-800' }} inline-flex rounded-full px-3 py-1 text-sm font-semibold">
                        {{ ucfirst($article->status) }}
                    </span>
                @endif

                <!-- Views Count -->
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    {{ $article->views ?? 0 }} views
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('articles.edit', $article?->slug) }}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Article
                </a>

                <button type="button"
                    onclick="if(confirm('Are you sure you want to delete this article?')) { document.getElementById('delete-form').submit(); }"
                    class="inline-flex items-center rounded-md border border-red-300 bg-white px-4 py-2 text-sm font-medium text-red-700 shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    Delete
                </button>

                <form id="delete-form" action="{{ route('articles.destroy', $article->id ?? 1) }}" method="POST"
                    class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>

        <!-- Article Content -->
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
            <!-- Featured Image -->
            <div class="aspect-w-16 aspect-h-9">
                <img src="{{ $article->getFirstMediaUrl('featured_images', '16-9') }}" alt="{{ $article->title }}"
                    class="h-64 w-full object-cover">
            </div>
            <!-- Article Header -->
            <div class="border-b border-gray-200 px-6 py-6">
                <h1 class="mb-4 text-3xl font-bold text-gray-900">
                    {{ $article->title ?? 'Sample Article Title: Getting Started with Laravel Development' }}
                </h1>

                <!-- Article Meta -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                    <div class="flex items-center">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        By {{ $article->author->name ?? 'John Doe' }}
                    </div>

                    <div class="flex items-center">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z">
                            </path>
                        </svg>
                        {{ isset($article->created_at) ? $article->created_at->format('M d, Y') : 'Jan 15, 2024' }}
                    </div>

                    <div class="flex items-center">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                        {{ $article->category->name ?? 'Programming' }}
                    </div>

                    <div class="flex items-center">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ isset($article->reading_time) ? $article->reading_time . ' min read' : '5 min read' }}
                    </div>
                </div>
            </div>

            <!-- Article Excerpt -->
            @if (isset($article->excerpt) && $article->excerpt)
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <p class="text-lg italic text-gray-700">{{ $article->excerpt }}</p>
                </div>
            @endif

            <!-- Article Content -->
            <div class="px-6 py-6">
                <div class="prose prose-lg max-w-none">
                    {!! $article->content ??
                        '
                                                                                                                                                                                                                                                                                                                                                                                        <p>Laravel is a powerful PHP framework that makes web development enjoyable and creative. In this comprehensive guide, we\'ll explore the fundamental concepts and best practices for building modern web applications with Laravel.</p>
                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                        <h2>Getting Started</h2>
                                                                                                                                                                                                                                                                                                                                                                                        <p>Before diving into Laravel development, it\'s important to understand the framework\'s philosophy and core principles. Laravel follows the Model-View-Controller (MVC) architectural pattern and emphasizes elegant syntax and developer happiness.</p>
                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                        <h3>Installation</h3>
                                                                                                                                                                                                                                                                                                                                                                                        <p>To get started with Laravel, you\'ll need to have PHP and Composer installed on your system. Once you have these prerequisites, you can create a new Laravel project using the following command:</p>
                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                        <pre><code>composer create-project laravel/laravel my-project</code></pre>
                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                        <h3>Directory Structure</h3>
                                                                                                                                                                                                                                                                                                                                                                                        <p>Laravel follows a conventional directory structure that helps organize your application code effectively. The main directories include:</p>
                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                        <ul>
                                                                                                                                                                                                                                                                                                                                                                                            <li><strong>app/</strong> - Contains the core application code</li>
                                                                                                                                                                                                                                                                                                                                                                                            <li><strong>config/</strong> - Configuration files</li>
                                                                                                                                                                                                                                                                                                                                                                                            <li><strong>database/</strong> - Database migrations and seeders</li>
                                                                                                                                                                                                                                                                                                                                                                                            <li><strong>resources/</strong> - Views, assets, and language files</li>
                                                                                                                                                                                                                                                                                                                                                                                            <li><strong>routes/</strong> - Route definitions</li>
                                                                                                                                                                                                                                                                                                                                                                                        </ul>
                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                        <h2>Key Features</h2>
                                                                                                                                                                                                                                                                                                                                                                                        <p>Laravel provides many powerful features out of the box, including:</p>
                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                        <ul>
                                                                                                                                                                                                                                                                                                                                                                                            <li>Eloquent ORM for database interactions</li>
                                                                                                                                                                                                                                                                                                                                                                                            <li>Blade templating engine</li>
                                                                                                                                                                                                                                                                                                                                                                                            <li>Artisan command-line interface</li>
                                                                                                                                                                                                                                                                                                                                                                                            <li>Built-in authentication and authorization</li>
                                                                                                                                                                                                                                                                                                                                                                                            <li>Queue system for background job processing</li>
                                                                                                                                                                                                                                                                                                                                                                                        </ul>
                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                        <h2>Conclusion</h2>
                                                                                                                                                                                                                                                                                                                                                                                        <p>Laravel continues to be one of the most popular PHP frameworks due to its elegant syntax, comprehensive feature set, and strong community support. Whether you\'re building a simple website or a complex web application, Laravel provides the tools and conventions you need to be productive.</p>
                                                                                                                                                                                                                                                                                                                                                                                        ' !!}
                </div>
            </div>

            <!-- Tags -->
            @if (isset($article->tags) && $article->tags)
                <div class="border-t border-gray-200 px-6 py-4">
                    <h4 class="mb-2 text-sm font-medium text-gray-900">Tags</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach (explode(',', $article->tags) as $tag)
                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800">
                                {{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="border-t border-gray-200 px-6 py-4">
                    <h4 class="mb-2 text-sm font-medium text-gray-900">Tags</h4>
                    <div class="flex flex-wrap gap-2">
                        <span
                            class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800">laravel</span>
                        <span
                            class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800">php</span>
                        <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800">web
                            development</span>
                        <span
                            class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800">tutorial</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Article Statistics -->
        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-8 w-8 items-center justify-center rounded-md bg-blue-500">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Views</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $article->views ?? '1,234' }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-8 w-8 items-center justify-center rounded-md bg-green-500">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Likes</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $article->likes ?? '89' }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-8 w-8 items-center justify-center rounded-md bg-purple-500">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Comments</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $article->comments_count ?? '12' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
