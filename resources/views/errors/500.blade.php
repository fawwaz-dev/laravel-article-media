<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error - Blog CMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-red-50 to-pink-100">
    <div class="flex min-h-screen items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg text-center">
            <!-- Error Illustration -->
            <div class="mb-8">
                <div class="relative mx-auto h-64 w-64">
                    <!-- 500 Number -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="select-none text-8xl font-bold text-red-200">500</span>
                    </div>
                    <!-- Server Icon -->
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                        <svg class="h-32 w-32 animate-bounce text-red-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Error Content -->
            <div class="space-y-6">
                <div>
                    <h1 class="mb-2 text-4xl font-bold text-gray-900">Internal Server Error</h1>
                    <p class="mb-4 text-lg text-gray-600">
                        Something went wrong on our end.
                    </p>
                    <p class="text-sm text-gray-500">
                        We're experiencing some technical difficulties. Our team has been notified and is working to fix
                        this issue.
                    </p>
                </div>

                <!-- Error ID (for tracking) -->
                <div class="rounded-lg border border-red-200 bg-red-50 p-4">
                    <div class="flex items-center">
                        <svg class="mr-2 h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-sm">
                            <p class="font-medium text-red-800">Error ID: {{ Str::random(8) }}</p>
                            <p class="text-red-600">{{ now()->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <button onclick="location.reload()"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Try Again
                    </button>

                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-6 py-3 text-sm font-medium text-white shadow-sm transition duration-150 ease-in-out hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        Go to Dashboard
                    </a>
                </div>

                <!-- Status Page Link -->
                <div class="mt-8">
                    <p class="mb-4 text-sm text-gray-600">Check our system status:</p>
                    <a href="#"
                        class="inline-flex items-center text-sm text-red-600 hover:text-red-700 hover:underline">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                        System Status Page
                    </a>
                </div>

                <!-- Contact Support -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <p class="mb-4 text-sm text-gray-600">Still having issues? Contact our support team:</p>
                    <div class="flex flex-wrap justify-center gap-4 text-sm">
                        <a href="mailto:support@blogcms.com"
                            class="text-red-600 hover:text-red-700 hover:underline">Email Support</a>
                        <a href="tel:+1234567890" class="text-red-600 hover:text-red-700 hover:underline">Call
                            Support</a>
                        <a href="#" class="text-red-600 hover:text-red-700 hover:underline">Live Chat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
