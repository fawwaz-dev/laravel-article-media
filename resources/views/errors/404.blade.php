<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Blog CMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="flex min-h-screen items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg text-center">
            <!-- Error Illustration -->
            <div class="mb-8">
                <div class="relative mx-auto h-64 w-64">
                    <!-- 404 Number -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="select-none text-8xl font-bold text-blue-200">404</span>
                    </div>
                    <!-- Magnifying Glass -->
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                        <svg class="h-32 w-32 animate-pulse text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Error Content -->
            <div class="space-y-6">
                <div>
                    <h1 class="mb-2 text-4xl font-bold text-gray-900">Page Not Found</h1>
                    <p class="mb-4 text-lg text-gray-600">
                        Oops! The page you're looking for doesn't exist.
                    </p>
                    <p class="text-sm text-gray-500">
                        It might have been moved, deleted, or you entered the wrong URL.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <button onclick="history.back()"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Go Back
                    </button>

                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-6 py-3 text-sm font-medium text-white shadow-sm transition duration-150 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        Go to Dashboard
                    </a>
                </div>

                <!-- Search Box -->
                <div class="mt-8">
                    <p class="mb-4 text-sm text-gray-600">Or search for what you're looking for:</p>
                    <form action="{{ route('articles.index') }}" method="GET" class="mx-auto max-w-md">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Search articles, pages..."
                                class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 pl-10 pr-4 text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="sr-only">Search</span>
                                <svg class="h-5 w-5 text-blue-600 hover:text-blue-700" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5-5 5M6 12h12"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Help Links -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <p class="mb-4 text-sm text-gray-600">Need help? Try these links:</p>
                    <div class="flex flex-wrap justify-center gap-4 text-sm">
                        <a href="{{ route('articles.index') }}"
                            class="text-blue-600 hover:text-blue-700 hover:underline">Articles</a>
                        <a href="{{ route('dashboard') }}"
                            class="text-blue-600 hover:text-blue-700 hover:underline">Dashboard</a>
                        <a href="mailto:support@blogcms.com"
                            class="text-blue-600 hover:text-blue-700 hover:underline">Contact Support</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
