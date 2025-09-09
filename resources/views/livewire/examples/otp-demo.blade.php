<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        @if ($step === 'login')
            <div class="bg-white rounded-lg shadow-md p-8">
                <livewire:components.otp-manager type="login" />
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Demo: Try different OTP types
                    </p>
                    <div class="mt-2 space-x-2">
                        <button onclick="switchOtpType('register')" class="text-xs text-blue-600 hover:text-blue-500">Register</button>
                        <button onclick="switchOtpType('password_reset')" class="text-xs text-blue-600 hover:text-blue-500">Reset Password</button>
                    </div>
                </div>
            </div>
        @elseif ($step === 'success')
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h3 class="text-lg font-medium text-gray-900 mb-2">Success!</h3>
                <p class="text-sm text-gray-600 mb-6">
                    You have successfully verified your email: <strong>{{ $user_email }}</strong>
                </p>
                
                <button wire:click="logout" 
                        class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Try Again
                </button>
            </div>
        @endif
    </div>
</div>

<script>
    function switchOtpType(type) {
        // This would typically be handled with Livewire events
        // For demo purposes, we'll just reload with different type
        console.log('Switching to OTP type:', type);
        // You could dispatch a Livewire event here to change the type
        // Livewire.dispatch('switch-otp-type', { type: type });
    }
</script>
