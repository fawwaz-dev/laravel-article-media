@extends('layouts.dashboard')

@section('title', 'Articles')
@section('page-title', 'Articles Management')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Articles</h1>
                <p class="mt-1 text-sm text-gray-600">Manage your blog articles and content</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('articles.create') }}"
                    class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Article
                </a>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <form method="GET" action="{{ route('articles.index') }}"
                class="space-y-4 sm:flex sm:items-center sm:space-x-4 sm:space-y-0">
                <!-- Search -->
                <div class="flex-1">
                    <label for="search" class="sr-only">Search articles</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 leading-5 placeholder-gray-500 focus:border-blue-500 focus:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            placeholder="Search articles...">
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="sm:w-48">
                    <label for="category" class="sr-only">Category</label>
                    <select name="category" id="category"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        <option value="">All Categories</option>
                        @foreach ($categories ?? [] as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="sm:w-40">
                    <label for="status" class="sr-only">Status</label>
                    <select name="status" id="status"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        <option value="">All Status</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published
                        </option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="flex space-x-2">
                    <button type="submit"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        Filter
                    </button>

                    @if (request()->hasAny(['search', 'category', 'status']))
                        <a href="{{ route('articles.index') }}"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Articles Table -->
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                <input type="checkbox" id="select-all"
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Article
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Category
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Views
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Date
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($articles ?? $sampleArticles as $article)
                            <tr class="hover:bg-gray-50">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <input type="checkbox" name="selected_articles[]" value="{{ $article->id }}"
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if (isset($article->featured_image) && $article->featured_image)
                                            <div class="h-12 w-12 flex-shrink-0">
                                                <img class="h-12 w-12 rounded-lg object-cover"
                                                    src="{{ asset('storage/' . $article->featured_image) }}"
                                                    alt="{{ $article->title }}">
                                            </div>
                                        @else
                                            <div
                                                class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-gray-200">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('articles.show', $article->slug) }}"
                                                    class="hover:text-blue-600">
                                                    {{ Str::limit($article->title, 50) }}
                                                </a>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                By {{ $article->author ?? 'Unknown Author' }}
                                            </div>
                                            @if (isset($article->content))
                                                <div class="mt-1 text-xs text-gray-400">
                                                    {{ Str::limit($article->content, 80) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-800">
                                        {{ $article->category ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'published' => 'bg-green-100 text-green-800',
                                            'draft' => 'bg-yellow-100 text-yellow-800',
                                            'archived' => 'bg-gray-100 text-gray-800',
                                        ];
                                    @endphp
                                    <span
                                        class="{{ $statusColors[$article->status] ?? 'bg-gray-100 text-gray-800' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="mr-1 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        {{ number_format($article->views ?? 0) }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    <div>{{ $article->created_at ?? 'Jan 15, 2024' }}</div>
                                    @if (isset($article->updated_at) && $article->updated_at !== $article->created_at)
                                        <div class="text-xs text-gray-400">Updated: {{ $article->updated_at }}</div>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('articles.show', $article->slug) }}"
                                            class="text-blue-600 hover:text-blue-900" title="View">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('articles.edit', $article->slug) }}"
                                            class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <button onclick="deleteArticle({{ $article->id }})"
                                            class="text-red-600 hover:text-red-900" title="Delete">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="mb-4 h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <h3 class="mb-2 text-lg font-medium text-gray-900">No articles found</h3>
                                        <p class="mb-4 text-gray-500">Get started by creating your first article.</p>
                                        <a href="{{ route('articles.create') }}"
                                            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Create Article
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if (isset($articles) && $articles->hasPages())
                <div class="border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>

        <!-- Bulk Actions -->
        <div id="bulk-actions"
            class="fixed bottom-4 left-1/2 hidden -translate-x-1/2 transform rounded-lg border border-gray-200 bg-white p-4 shadow-lg">
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">
                    <span id="selected-count">0</span> articles selected
                </span>
                <div class="flex space-x-2">
                    <button onclick="bulkAction('publish')"
                        class="inline-flex items-center rounded border border-transparent bg-green-100 px-3 py-1 text-xs font-medium text-green-700 hover:bg-green-200">
                        Publish
                    </button>
                    <button onclick="bulkAction('draft')"
                        class="inline-flex items-center rounded border border-transparent bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700 hover:bg-yellow-200">
                        Draft
                    </button>
                    <button onclick="bulkAction('delete')"
                        class="inline-flex items-center rounded border border-transparent bg-red-100 px-3 py-1 text-xs font-medium text-red-700 hover:bg-red-200">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Checkbox functionality
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const articleCheckboxes = document.querySelectorAll('input[name="selected_articles[]"]');
            const bulkActionsDiv = document.getElementById('bulk-actions');
            const selectedCountSpan = document.getElementById('selected-count');

            // Select all functionality
            selectAllCheckbox.addEventListener('change', function() {
                articleCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkActions();
            });

            // Individual checkbox functionality
            articleCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectAllState();
                    updateBulkActions();
                });
            });

            function updateSelectAllState() {
                const checkedBoxes = document.querySelectorAll('input[name="selected_articles[]"]:checked');
                selectAllCheckbox.checked = checkedBoxes.length === articleCheckboxes.length;
                selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < articleCheckboxes
                    .length;
            }

            function updateBulkActions() {
                const checkedBoxes = document.querySelectorAll('input[name="selected_articles[]"]:checked');
                if (checkedBoxes.length > 0) {
                    bulkActionsDiv.classList.remove('hidden');
                    selectedCountSpan.textContent = checkedBoxes.length;
                } else {
                    bulkActionsDiv.classList.add('hidden');
                }
            }
        });

        // Delete article function
        function deleteArticle(articleId) {
            if (confirm('Are you sure you want to delete this article? This action cannot be undone.')) {
                const form = document.getElementById('delete-form');
                form.action = `/articles/${articleId}`;
                form.submit();
            }
        }

        // Bulk actions
        function bulkAction(action) {
            const checkedBoxes = document.querySelectorAll('input[name="selected_articles[]"]:checked');
            const articleIds = Array.from(checkedBoxes).map(cb => cb.value);

            if (articleIds.length === 0) {
                alert('Please select at least one article.');
                return;
            }

            let confirmMessage = '';
            switch (action) {
                case 'publish':
                    confirmMessage = `Are you sure you want to publish ${articleIds.length} article(s)?`;
                    break;
                case 'draft':
                    confirmMessage = `Are you sure you want to move ${articleIds.length} article(s) to draft?`;
                    break;
                case 'delete':
                    confirmMessage =
                        `Are you sure you want to delete ${articleIds.length} article(s)? This action cannot be undone.`;
                    break;
            }

            if (confirm(confirmMessage)) {
                // Here you would typically send an AJAX request to handle bulk actions
                console.log(`Bulk ${action} for articles:`, articleIds);
                // For demo purposes, just show an alert
                alert(`Bulk ${action} action would be performed on ${articleIds.length} article(s).`);
            }
        }
    </script>
@endsection
