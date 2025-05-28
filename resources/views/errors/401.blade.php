<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Expired - Blog CMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-purple-50 to-indigo-100">
    <div class="flex min-h-screen items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg text-center">
            <!-- Error Illustration -->
            <div class="mb-8">
                <div class="relative mx-auto h-64 w-64">
                    <!-- 419 Number -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="select-none text-8xl font-bold text-purple-200">419</span>
                    </div>
                    <!-- Clock Icon -->
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                        <svg class="h-32 w-32 animate-spin text-purple-600" style="animation-duration: 3s;"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Error Content -->
            <div class="space-y-6">
                <div>
                    <h1 class="mb-2 text-4xl font-bold text-gray-900">Page Expired</h1>
                    <p class="mb-4 text-lg text-gray-600">
                        Your session has expired for security reasons.
                    </p>
                    <p class="text-sm text-gray-500">
                        This usually happens when you've been inactive for too long or when there's a CSRF token
                        mismatch.
                    </p>
                </div>

                <!-- CSRF Info -->
                <div class="rounded-lg border border-purple-200 bg-purple-50 p-4">
                    <div class="flex items-start">
                        <svg class="mr-3 mt-0.5 h-5 w-5 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-left text-sm">
                            <p class="font-medium text-purple-800">What happened?</p>
                            <ul class="mt-1 space-y-1 text-purple-700">
                                <li>• Your security token has expired</li>
                                <li>• The page was open for too long</li>
                                <li>• Multiple tabs may have caused conflicts</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <button onclick="location.reload()"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Refresh Page
                    </button>

                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center rounded-md border border-transparent bg-purple-600 px-6 py-3 text-sm font-medium text-white shadow-sm transition duration-150 ease-in-out hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        Go to Dashboard
                    </a>
                </div>

                <!-- Auto Refresh -->
                <div class="mt-8">
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <div class="flex items-center justify-center">
                            <svg class="mr-2 h-5 w-5 animate-spin text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            <span class="text-sm text-gray-600">Auto-refreshing in <span id="countdown">10</span>
                                seconds...</span>
                        </div>
                        <button onclick="clearAutoRefresh()"
                            class="mt-2 text-xs text-gray-500 underline hover:text-gray-700">
                            Cancel auto-refresh
                        </button>
                    </div>
                </div>

                <!-- Prevention Tips -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <p class="mb-4 text-sm text-gray-600">To prevent this in the future:</p>
                    <div class="space-y-1 text-xs text-gray-500">
                        <p>• Save your work frequently</p>
                        <p>• Avoid keeping forms open for extended periods</p>
                        <p>• Use only one tab for important operations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let countdown = 10;
        let autoRefreshTimer;

        function startCountdown() {
            autoRefreshTimer = setInterval(function() {
                countdown--;
                document.getElementById('countdown').textContent = countdown;

                if (countdown <= 0) {
                    location.reload();
                }
            }, 1000);
        }

        function clearAutoRefresh() {
            clearInterval(autoRefreshTimer);
            document.querySelector('[class*="Auto-refreshing"]').style.display = 'none';
        }

        // Start countdown when page loads
        document.addEventListener('DOMContentLoaded', startCountdown);
    </script>
</body>

</html>
