<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Blog CMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100">
    <div class="flex min-h-screen items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-600">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Verify Your Identity
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    We've sent a verification code to
                </p>
                <p class="text-sm font-medium text-green-600">
                    {{ session('otp_email') ?? 'your registered email' }}
                </p>
            </div>

            <!-- OTP Form -->
            <div class="rounded-lg bg-white p-8 shadow-lg">
                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="mb-4 rounded-md border border-green-200 bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-inside list-disc space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('otp.verify') }}" class="space-y-6">
                    @csrf

                    <!-- OTP Input Fields -->
                    <div>
                        <label class="mb-4 block text-center text-sm font-medium text-gray-700">
                            Enter 6-digit verification code
                        </label>
                        <div class="flex justify-center space-x-3">
                            <input type="text" id="otp-1" name="otp[]" maxlength="1"
                                class="@error('otp') border-red-500 @enderror h-12 w-12 rounded-lg border border-gray-300 text-center text-2xl font-bold focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500"
                                autocomplete="off" required>
                            <input type="text" id="otp-2" name="otp[]" maxlength="1"
                                class="@error('otp') border-red-500 @enderror h-12 w-12 rounded-lg border border-gray-300 text-center text-2xl font-bold focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500"
                                autocomplete="off" required>
                            <input type="text" id="otp-3" name="otp[]" maxlength="1"
                                class="@error('otp') border-red-500 @enderror h-12 w-12 rounded-lg border border-gray-300 text-center text-2xl font-bold focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500"
                                autocomplete="off" required>
                            <input type="text" id="otp-4" name="otp[]" maxlength="1"
                                class="@error('otp') border-red-500 @enderror h-12 w-12 rounded-lg border border-gray-300 text-center text-2xl font-bold focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500"
                                autocomplete="off" required>
                            <input type="text" id="otp-5" name="otp[]" maxlength="1"
                                class="@error('otp') border-red-500 @enderror h-12 w-12 rounded-lg border border-gray-300 text-center text-2xl font-bold focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500"
                                autocomplete="off" required>
                            <input type="text" id="otp-6" name="otp[]" maxlength="1"
                                class="@error('otp') border-red-500 @enderror h-12 w-12 rounded-lg border border-gray-300 text-center text-2xl font-bold focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500"
                                autocomplete="off" required>
                        </div>
                        @error('otp')
                            <p class="mt-2 text-center text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Timer -->
                    <div class="text-center">
                        <div id="timer-container" class="mb-4">
                            <p class="text-sm text-gray-600">
                                Code expires in: <span id="timer" class="font-medium text-green-600">05:00</span>
                            </p>
                            <div class="mt-2">
                                <div class="mx-auto h-2 max-w-xs rounded-full bg-gray-200">
                                    <div id="timer-progress"
                                        class="h-2 rounded-full bg-green-600 transition-all duration-1000 ease-linear"
                                        style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" id="verify-button"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-green-600 px-4 py-3 text-sm font-medium text-white transition duration-150 ease-in-out hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-green-500 group-hover:text-green-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                            <span id="button-text">Verify Code</span>
                            <svg id="loading-spinner" class="-mr-1 ml-3 hidden h-5 w-5 animate-spin text-white"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <!-- Resend Code -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Didn't receive the code?
                        </p>
                        <button type="button" id="resend-button" onclick="resendOTP()"
                            class="mt-2 font-medium text-green-600 transition duration-150 ease-in-out hover:text-green-500 focus:underline focus:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                            disabled>
                            <span id="resend-text">Resend in <span id="resend-timer">60</span>s</span>
                        </button>
                    </div>

                    <!-- Alternative Actions -->
                    <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                        <a href="{{ route('login') }}"
                            class="text-sm text-gray-600 transition duration-150 ease-in-out hover:text-gray-900 focus:underline focus:outline-none">
                            ← Back to Login
                        </a>

                        <button type="button" onclick="changeEmail()"
                            class="text-sm text-green-600 transition duration-150 ease-in-out hover:text-green-500 focus:underline focus:outline-none">
                            Change Email
                        </button>
                    </div>
                </form>
            </div>

            <!-- Help Section -->
            <div class="rounded-lg border border-blue-200 bg-blue-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Having trouble?</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-inside list-disc space-y-1">
                                <li>Check your spam/junk folder</li>
                                <li>Make sure you entered the correct email</li>
                                <li>Wait a few minutes for the email to arrive</li>
                                <li>Contact support if issues persist</li>
                            </ul>
                        </div>
                        <div class="mt-3">
                            <a href="mailto:support@blogcms.com"
                                class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                Contact Support →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // OTP Input Handling
        document.addEventListener('DOMContentLoaded', function() {
            const otpInputs = document.querySelectorAll('input[name="otp[]"]');

            otpInputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    const value = e.target.value;

                    // Only allow numbers
                    if (!/^\d$/.test(value)) {
                        e.target.value = '';
                        return;
                    }

                    // Move to next input
                    if (value && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }

                    // Check if all inputs are filled
                    checkAllInputsFilled();
                });

                input.addEventListener('keydown', function(e) {
                    // Handle backspace
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        otpInputs[index - 1].focus();
                    }

                    // Handle paste
                    if (e.key === 'v' && (e.ctrlKey || e.metaKey)) {
                        e.preventDefault();
                        navigator.clipboard.readText().then(text => {
                            const digits = text.replace(/\D/g, '').slice(0, 6);
                            digits.split('').forEach((digit, i) => {
                                if (otpInputs[i]) {
                                    otpInputs[i].value = digit;
                                }
                            });
                            checkAllInputsFilled();
                        });
                    }
                });
            });

            function checkAllInputsFilled() {
                const allFilled = Array.from(otpInputs).every(input => input.value);
                const verifyButton = document.getElementById('verify-button');

                if (allFilled) {
                    verifyButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    verifyButton.disabled = false;
                } else {
                    verifyButton.classList.add('opacity-50', 'cursor-not-allowed');
                    verifyButton.disabled = true;
                }
            }

            // Initial check
            checkAllInputsFilled();
        });

        // Timer functionality
        let timeLeft = 300; // 5 minutes in seconds
        let resendTimeLeft = 60; // 1 minute for resend
        const totalTime = 300;

        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;

            document.getElementById('timer').textContent =
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            // Update progress bar
            const progress = (timeLeft / totalTime) * 100;
            document.getElementById('timer-progress').style.width = progress + '%';

            if (timeLeft <= 0) {
                // Timer expired
                document.getElementById('timer-container').innerHTML =
                    '<p class="text-sm text-red-600 font-medium">Code has expired. Please request a new one.</p>';

                // Disable verify button
                const verifyButton = document.getElementById('verify-button');
                verifyButton.disabled = true;
                verifyButton.classList.add('opacity-50', 'cursor-not-allowed');

                // Enable resend button
                enableResendButton();

                clearInterval(timerInterval);
                return;
            }

            timeLeft--;
        }

        function updateResendTimer() {
            const resendButton = document.getElementById('resend-button');
            const resendText = document.getElementById('resend-text');
            const resendTimerSpan = document.getElementById('resend-timer');

            if (resendTimeLeft <= 0) {
                enableResendButton();
                clearInterval(resendTimerInterval);
                return;
            }

            resendTimerSpan.textContent = resendTimeLeft;
            resendTimeLeft--;
        }

        function enableResendButton() {
            const resendButton = document.getElementById('resend-button');
            const resendText = document.getElementById('resend-text');

            resendButton.disabled = false;
            resendButton.classList.remove('opacity-50', 'cursor-not-allowed');
            resendText.innerHTML = 'Resend Code';
        }

        // Start timers
        const timerInterval = setInterval(updateTimer, 1000);
        const resendTimerInterval = setInterval(updateResendTimer, 1000);
        updateTimer(); // Initial call
        updateResendTimer(); // Initial call

        // Form submission with loading state
        document.querySelector('form').addEventListener('submit', function() {
            const button = document.getElementById('verify-button');
            const buttonText = document.getElementById('button-text');
            const spinner = document.getElementById('loading-spinner');

            button.disabled = true;
            buttonText.textContent = 'Verifying...';
            spinner.classList.remove('hidden');
        });

        // Resend OTP function
        async function resendOTP() {
            const resendButton = document.getElementById('resend-button');
            const resendText = document.getElementById('resend-text');

            resendButton.disabled = true;
            resendText.innerHTML = 'Sending...';

            try {
                const response = await fetch('{{ route('otp.resend') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Reset timers
                    timeLeft = 300;
                    resendTimeLeft = 60;

                    // Show success message
                    showMessage('New verification code sent!', 'success');

                    // Clear OTP inputs
                    document.querySelectorAll('input[name="otp[]"]').forEach(input => {
                        input.value = '';
                    });
                    document.getElementById('otp-1').focus();
                } else {
                    showMessage(data.message || 'Failed to resend code. Please try again.', 'error');
                    enableResendButton();
                }
            } catch (error) {
                showMessage('Network error. Please try again.', 'error');
                enableResendButton();
            }
        }


        // Show message function
        function showMessage(message, type) {
            const alertClass = type === 'success' ? 'bg-green-50 border-green-200 text-green-800' :
                'bg-red-50 border-red-200 text-red-800';
            const iconPath = type === 'success' ?
                'M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z' :
                'M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z';

            const messageDiv = document.createElement('div');
            messageDiv.className = `mb-4 p-4 rounded-md border ${alertClass}`;
            messageDiv.innerHTML = `
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="${iconPath}" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">${message}</p>
                    </div>
                </div>
            `;

            const form = document.querySelector('form');
            form.insertBefore(messageDiv, form.firstChild);

            // Remove message after 5 seconds
            setTimeout(() => {
                messageDiv.remove();
            }, 5000);
        }

        // Auto-focus first input
        document.getElementById('otp-1').focus();
    </script>
</body>

</html>
