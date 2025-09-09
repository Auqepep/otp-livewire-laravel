<?php

namespace App\Livewire\Examples;

use Livewire\Component;

class OtpDemo extends Component
{
    public $step = 'login'; // 'login', 'success'
    public $user_email = '';

    protected $listeners = [
        'otp-verified' => 'handleOtpVerified'
    ];

    public function handleOtpVerified($data)
    {
        $this->user_email = $data['email'];
        
        // Handle different OTP types
        switch ($data['type']) {
            case 'login':
                // Log the user in
                $user = \App\Models\User::where('email', $data['email'])->first();
                if ($user) {
                    auth()->login($user);
                    $this->step = 'success';
                }
                break;
                
            case 'register':
                // Handle registration verification
                $this->step = 'success';
                break;
                
            case 'password_reset':
                // Handle password reset
                $this->step = 'success';
                break;
        }
    }

    public function logout()
    {
        auth()->logout();
        $this->step = 'login';
        $this->reset('user_email');
    }

    public function render()
    {
        return view('livewire.examples.otp-demo')
            ->layout('layouts.app');
    }
}
