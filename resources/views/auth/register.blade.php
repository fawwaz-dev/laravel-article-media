<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Blog CMS</title>
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
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                </div>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Create your account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Join Blog CMS and start creating amazing content
                </p>
            </div>

            <!-- Register Form -->
            <div class="rounded-lg bg-white p-8 shadow-lg">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4">
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

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                            Full Name
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                autofocus
                                class="@error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror block w-full rounded-md border border-gray-300 bg-white py-3 pl-10 pr-3 leading-5 placeholder-gray-500 focus:border-green-500 focus:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="Enter your full name">
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                class="@error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror block w-full rounded-md border border-gray-300 bg-white py-3 pl-10 pr-3 leading-5 placeholder-gray-500 focus:border-green-500 focus:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="Enter your email address">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required
                                class="@error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror block w-full rounded-md border border-gray-300 bg-white py-3 pl-10 pr-10 leading-5 placeholder-gray-500 focus:border-green-500 focus:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="Create a strong password">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button type="button" onclick="togglePassword('password')"
                                    class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <svg id="password-eye-open" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <svg id="password-eye-closed" class="hidden h-5 w-5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Password Strength Indicator -->
                        <div class="mt-2">
                            <div class="flex items-center space-x-2">
                                <div class="flex-1">
                                    <div class="h-2 rounded-full bg-gray-200">
                                        <div id="password-strength-bar"
                                            class="h-2 rounded-full transition-all duration-300 ease-in-out"
                                            style="width: 0%"></div>
                                    </div>
                                </div>
                                <span id="password-strength-text" class="text-xs text-gray-500">Weak</span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Password must be at least 8 characters long</p>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="@error('password_confirmation') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror block w-full rounded-md border border-gray-300 bg-white py-3 pl-10 pr-10 leading-5 placeholder-gray-500 focus:border-green-500 focus:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="Confirm your password">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button type="button" onclick="togglePassword('password_confirmation')"
                                    class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <svg id="confirm-eye-open" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <svg id="confirm-eye-closed" class="hidden h-5 w-5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Password Match Indicator -->
                        <div id="password-match" class="mt-1 hidden text-xs">
                            <span id="password-match-text"></span>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-start">
                        <div class="flex h-5 items-center">
                            <input id="terms" name="terms" type="checkbox" required
                                class="@error('terms') border-red-500 @enderror h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-gray-700">
                                I agree to the
                                <a href="#" class="font-medium text-green-600 hover:text-green-500">Terms and
                                    Conditions</a>
                                and
                                <a href="#" class="font-medium text-green-600 hover:text-green-500">Privacy
                                    Policy</a>
                            </label>
                            @error('terms')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-green-600 px-4 py-3 text-sm font-medium text-white transition duration-150 ease-in-out hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-green-500 group-hover:text-green-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                    </path>
                                </svg>
                            </span>
                            Create Account
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <a href="{{ route('login') }}"
                                class="font-medium text-green-600 transition duration-150 ease-in-out hover:text-green-500 focus:underline focus:outline-none">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Features -->
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-medium text-gray-900">What you'll get:</h3>
                <ul class="space-y-3">
                    <li class="flex items-center">
                        <svg class="mr-3 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Full access to content management system</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="mr-3 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Create and publish unlimited articles</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="mr-3 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Advanced analytics and insights</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="mr-3 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-700">24/7 customer support</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const eyeOpen = document.getElementById(fieldId === 'password' ? 'password-eye-open' : 'confirm-eye-open');
            const eyeClosed = document.getElementById(fieldId === 'password' ? 'password-eye-closed' :
                'confirm-eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');

            let strength = 0;
            let strengthLabel = 'Weak';
            let strengthColor = 'bg-red-500';

            // Check password criteria
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 25;

            // Determine strength level
            if (strength >= 100) {
                strengthLabel = 'Very Strong';
                strengthColor = 'bg-green-600';
            } else if (strength >= 75) {
                strengthLabel = 'Strong';
                strengthColor = 'bg-green-500';
            } else if (strength >= 50) {
                strengthLabel = 'Medium';
                strengthColor = 'bg-yellow-500';
            } else if (strength >= 25) {
                strengthLabel = 'Fair';
                strengthColor = 'bg-orange-500';
            }

            // Update UI
            strengthBar.style.width = Math.min(strength, 100) + '%';
            strengthBar.className = `h-2 rounded-full transition-all duration-300 ease-in-out ${strengthColor}`;
            strengthText.textContent = strengthLabel;

            // Check password confirmation match
            checkPasswordMatch();
        });

        // Password confirmation checker
        document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            const matchDiv = document.getElementById('password-match');
            const matchText = document.getElementById('password-match-text');

            if (confirmation.length > 0) {
                matchDiv.classList.remove('hidden');
                if (password === confirmation) {
                    matchText.textContent = '✓ Passwords match';
                    matchText.className = 'text-green-600';
                } else {
                    matchText.textContent = '✗ Passwords do not match';
                    matchText.className = 'text-red-600';
                }
            } else {
                matchDiv.classList.add('hidden');
            }
        }

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            const terms = document.getElementById('terms').checked;

            if (password !== confirmation) {
                e.preventDefault();
                alert('Passwords do not match. Please check and try again.');
                return false;
            }

            if (!terms) {
                e.preventDefault();
                alert('Please accept the Terms and Conditions to continue.');
                return false;
            }
        });
    </script>
</body>

</html>
