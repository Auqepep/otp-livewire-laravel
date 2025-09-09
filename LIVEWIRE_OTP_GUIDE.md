# Livewire OTP Implementation

This Laravel application now includes a comprehensive Livewire-based OTP (One-Time Password) authentication system. Here's how it's structured and how to use it.

## Components Overview

### 1. Login Component (`App\Livewire\Auth\Login`)

-   **Location**: `app/Livewire/Auth/Login.php`
-   **View**: `resources/views/livewire/auth/login.blade.php`
-   **Route**: `/login`

**Features**:

-   Two-step authentication (email → OTP verification)
-   Real-time validation
-   Loading states and user feedback
-   Auto-submit when 6 digits are entered
-   Countdown timer for resend functionality
-   Email verification check before sending OTP

### 2. Register Component (`App\Livewire\Auth\Register`)

-   **Location**: `app/Livewire/Auth/Register.php`
-   **View**: `resources/views/livewire/auth/register.blade.php`
-   **Route**: `/register`

**Features**:

-   User registration with email verification
-   Email verification link sending
-   Resend verification email functionality
-   Loading states and user feedback

### 3. OTP Manager Component (`App\Livewire\Components\OtpManager`)

-   **Location**: `app/Livewire/Components/OtpManager.php`
-   **View**: `resources/views/livewire/components/otp-manager.blade.php`

**Features**:

-   Reusable component for any OTP scenario
-   Supports multiple OTP types (login, register, password_reset)
-   Dynamic mode switching (send/verify)
-   Configurable titles and subtitles
-   Auto-verification option

### 4. OTP Verification Component (`App\Livewire\Components\OtpVerification`)

-   **Location**: `app/Livewire/Components/OtpVerification.php`
-   **View**: `resources/views/livewire/components/otp-verification.blade.php`

**Features**:

-   Simple verification-only component
-   Emits events when OTP is verified
-   Countdown timer and resend functionality

## Usage Examples

### Using the OTP Manager Component

```php
<!-- Basic usage -->
<livewire:components.otp-manager type="login" />

<!-- With custom email -->
<livewire:components.otp-manager type="login" email="user@example.com" />

<!-- Different OTP types -->
<livewire:components.otp-manager type="register" />
<livewire:components.otp-manager type="password_reset" />
```

### Listening for OTP Verification Events

```php
// In your Livewire component
protected $listeners = [
    'otp-verified' => 'handleOtpVerified'
];

public function handleOtpVerified($data)
{
    // $data contains: email, type, otp
    $email = $data['email'];
    $type = $data['type'];

    switch ($type) {
        case 'login':
            // Log the user in
            $user = User::where('email', $email)->first();
            auth()->login($user);
            break;

        case 'register':
            // Complete registration
            break;

        case 'password_reset':
            // Allow password reset
            break;
    }
}
```

### Using OTP Verification Component

```php
<!-- For verification only -->
<livewire:components.otp-verification
    email="user@example.com"
    type="login"
    title="Enter Your Login Code"
    subtitle="Check your email for the 6-digit code" />
```

## Key Features

### 1. Real-time Validation

-   Livewire attributes for immediate feedback
-   Debounced input validation
-   Auto-formatting for OTP inputs

### 2. Loading States

-   Visual feedback during API calls
-   Disabled buttons during processing
-   Spinning indicators

### 3. Enhanced UX

-   Auto-focus management
-   Auto-submit when OTP is complete
-   Countdown timers for resend functionality
-   Clear error messaging

### 4. Security Features

-   Rate limiting on OTP requests
-   Automatic cleanup of expired OTPs
-   Email verification checks
-   Proper validation rules

### 5. Accessibility

-   Proper ARIA labels
-   Keyboard navigation support
-   Screen reader compatible
-   Focus management

## Configuration

### OTP Settings

The OTP behavior is configured in the `EmailOtp` model:

-   **Expiry Time**: 10 minutes
-   **OTP Length**: 6 digits
-   **Cleanup**: Automatic on generation and verification

### Email Settings

OTP emails are sent via the `SendOtpMail` mailable:

-   **Templates**: Located in `resources/views/emails/`
-   **Types**: login, register, password_reset
-   **SMTP**: Configured in `.env` file

## Testing

### Demo Page

Visit `/otp-demo` to test the OTP functionality without affecting your main authentication flow.

### Manual Testing

1. Register a new user
2. Check email for verification link
3. Click verification link
4. Try logging in with OTP
5. Check email for OTP code
6. Enter code to complete login

## Customization

### Styling

All components use Tailwind CSS classes and can be customized by modifying the Blade templates.

### Behavior

You can customize OTP behavior by:

-   Modifying the `EmailOtp` model
-   Updating validation rules in components
-   Changing email templates
-   Adjusting timeout values

### Events

Components emit Livewire events that you can listen to:

-   `otp-verified`: When OTP is successfully verified
-   `focus-email`: To focus email input
-   `focus-otp`: To focus OTP input
-   `start-countdown`: To start resend countdown

## Best Practices

1. **Always validate email verification** before sending login OTPs
2. **Use proper rate limiting** to prevent spam
3. **Clean up expired OTPs** regularly
4. **Provide clear user feedback** during all operations
5. **Test email delivery** in your production environment
6. **Use HTTPS** for all OTP-related pages
7. **Log security events** for monitoring

## Troubleshooting

### Common Issues

1. **Emails not sending**: Check SMTP configuration in `.env`
2. **OTP not working**: Verify database migrations are run
3. **Validation errors**: Check input formats and requirements
4. **Session issues**: Ensure proper session configuration

### Debug Mode

Enable Laravel debug mode to see detailed error messages during development.

## Migration from Traditional Auth

If migrating from password-based auth:

1. Remove password requirements from registration
2. Update user factory for testing
3. Modify password reset flows
4. Update middleware as needed

This Livewire OTP implementation provides a modern, secure, and user-friendly authentication experience while maintaining flexibility for different use cases.
