<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Too Many Requests - Blog CMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-orange-50 to-red-100">
    <div class="flex min-h-screen items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg text-center">
            <!-- Error Illustration -->
            <div class="mb-8">
                <div class="relative mx-auto h-64 w-64">
                    <!-- 429 Number -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="select-none text-8xl font-bold text-orange-200">429</span>
                    </div>
                    <!-- Speed Limit Icon -->
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                        <svg class="h-32 w-32 animate-bounce text-orange-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Error Content -->
            <div class="space-y-6">
                <div>
                    <h1 class="mb-2 text-4xl font-bold text-gray-900">Too Many Requests</h1>
                    <p class="mb-4 text-lg text-gray-600">
                        Whoa there! You're going a bit too fast.
                    </p>
                    <p class="text-sm text-gray-500">
                        You've exceeded the rate limit. Please wait a moment before trying again.
                    </p>
                </div>

                <!-- Rate Limit Info -->
                <div class="rounded-lg border border-orange-200 bg-orange-50 p-4">
                    <div class="flex items-start">
                        <svg class="mr-3 mt-0.5 h-5 w-5 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-left text-sm">
                            <p class="font-medium text-orange-800">Rate Limit Details:</p>
                            <ul class="mt-1 space-y-1 text-orange-700">
                                <li>• Maximum requests exceeded</li>
                                <li>• Cooldown period: <span id="cooldown-time">60 seconds</span></li>
                                <li>• This helps protect our servers</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Countdown Timer -->
                <div class="rounded-lg border border-gray-200 bg-white p-6">
                    <div class="text-center">
                        <h3 class="mb-2 text-lg font-medium text-gray-900">Please wait</h3>
                        <div class="mb-2 text-4xl font-bold text-orange-600">
                            <span id="countdown-minutes">01</span>:<span id="countdown-seconds">00</span>
                        </div>
                        <p class="text-sm text-gray-500">Time remaining until you can try again</p>

                        <!-- Progress Bar -->
                        <div class="mt-4">
                            <div class="h-2 rounded-full bg-gray-200">
                                <div id="progress-bar"
                                    class="h-2 rounded-full bg-orange-600 transition-all duration-1000 ease-linear"
                                    style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <button onclick="location.reload()" id="retry-button" disabled
                        class="inline-flex cursor-not-allowed items-center rounded-md border border-gray-300 bg-gray-100 px-6 py-3 text-sm font-medium text-gray-400 shadow-sm transition duration-150 ease-in-out">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Try Again
                    </button>

                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center rounded-md border border-transparent bg-orange-600 px-6 py-3 text-sm font-medium text-white shadow-sm transition duration-150 ease-in-out hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        Go to Dashboard
                    </a>
                </div>

                <!-- Tips -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <p class="mb-4 text-sm text-gray-600">Tips to avoid rate limiting:</p>
                    <div class="space-y-1 text-xs text-gray-500">
                        <p>• Slow down your requests</p>
                        <p>• Avoid rapid clicking or refreshing</p>
                        <p>• Use browser bookmarks instead of repeated searches</p>
                        <p>• Contact support if you need higher limits</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let timeLeft = 60; // 60 seconds cooldown
        const totalTime = 60;

        function updateCountdown() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;

            document.getElementById('countdown-minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('countdown-seconds').textContent = seconds.toString().padStart(2, '0');

            // Update progress bar
            const progress = ((totalTime - timeLeft) / totalTime) * 100;
            document.getElementById('progress-bar').style.width = progress + '%';

            if (timeLeft <= 0) {
                // Enable retry button
                const retryButton = document.getElementById('retry-button');
                retryButton.disabled = false;
                retryButton.className = retryButton.className
                    .replace('text-gray-400 bg-gray-100 cursor-not-allowed',
                        'text-gray-700 bg-white hover:bg-gray-50 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500'
                        );

                // Update countdown display
                document.getElementById('countdown-minutes').textContent = '00';
                document.getElementById('countdown-seconds').textContent = '00';
                document.getElementById('progress-bar').style.width = '100%';

                // Show ready message
                document.querySelector('[class*="Time remaining"]').textContent = 'You can now try again!';

                clearInterval(countdownTimer);
                return;
            }

            timeLeft--;
        }

        // Start countdown
        const countdownTimer = setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call

        // Auto-refresh when countdown reaches zero
        setTimeout(() => {
            if (confirm('Rate limit period has ended. Would you like to refresh the page?')) {
                location.reload();
            }
        }, totalTime * 1000);
    </script>
</body>

</html>
