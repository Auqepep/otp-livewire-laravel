<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold">{{ config('app.name', 'Laravel') }}</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-12">
        @if (session()->has('message'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('message') }}
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Welcome to your Dashboard!</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-blue-800">Email Verified</h3>
                            <p class="text-blue-600">✓ Your email has been verified via link</p>
                        </div>
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-800">OTP Login</h3>
                            <p class="text-green-600">✓ Secure OTP authentication for login</p>
                        </div>
                        <div class="bg-purple-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-purple-800">Profile</h3>
                            <p class="text-purple-600">
                                <strong>Name:</strong> {{ auth()->user()->name }}<br>
                                <strong>Email:</strong> {{ auth()->user()->email }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Authentication Features</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-600">
                            <li><strong>Registration:</strong> Simple form with email verification link</li>
                            <li><strong>Login:</strong> Email OTP authentication (no passwords)</li>
                            <li><strong>Email verification:</strong> One-click verification via email link</li>
                            <li><strong>Security:</strong> Signed URLs with 60-minute expiration</li>
                            <li><strong>Auto-login:</strong> Users are logged in after email verification</li>
                            <li><strong>Real emails:</strong> Sent via Gmail SMTP</li>
                            <li>Automatic cleanup of used and expired OTPs</li>
                            <li>Scheduled cleanup runs every hour</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
