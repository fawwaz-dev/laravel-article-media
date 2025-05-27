@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg bg-white p-6 shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-8 w-8 items-center justify-center rounded-md bg-blue-500">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Articles</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalArticles ?? '24' }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-8 w-8 items-center justify-center rounded-md bg-green-500">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Categories</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalCategories ?? '8' }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-8 w-8 items-center justify-center rounded-md bg-purple-500">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Users</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers ?? '12' }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-8 w-8 items-center justify-center rounded-md bg-yellow-500">
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
                        <p class="text-sm font-medium text-gray-500">Views Today</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $todayViews ?? '1,234' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Articles -->
        <div class="rounded-lg bg-white shadow">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">Recent Articles</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">Getting Started with Laravel</div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span
                                    class="inline-flex rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-800">
                                    Tutorial
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span
                                    class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">
                                    Published
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                Jan 15, 2024
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                <a href="#" class="mr-3 text-blue-600 hover:text-blue-900">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">Advanced PHP Techniques</div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span
                                    class="inline-flex rounded-full bg-purple-100 px-2 py-1 text-xs font-semibold text-purple-800">
                                    Programming
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span
                                    class="inline-flex rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-800">
                                    Draft
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                Jan 12, 2024
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                <a href="#" class="mr-3 text-blue-600 hover:text-blue-900">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
