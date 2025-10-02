<?php

namespace Tests\Feature;

use App\Models\User;
use App\Mail\VerifyEmailMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_link_works()
    {
        // Create an unverified user
        $user = User::factory()->unverified()->create([
            'email' => 'test@example.com'
        ]);

        // Generate verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );

        // Visit the verification URL
        $response = $this->get($verificationUrl);

        // Should redirect to dashboard
        $response->assertRedirect('/dashboard');

        // User should now be verified and logged in
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_verification_link_fails()
    {
        $user = User::factory()->unverified()->create();

        // Generate URL with wrong hash
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => 'wrong-hash',
            ]
        );

        // Visit the verification URL
        $response = $this->get($verificationUrl);

        // Should redirect to login with error
        $response->assertRedirect('/login');
        $response->assertSessionHas('error', 'Invalid verification link.');

        // User should still be unverified
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }

    public function test_verification_email_can_be_sent()
    {
        Mail::fake();

        $user = User::factory()->unverified()->create();

        // Send verification email
        Mail::to($user->email)->send(new VerifyEmailMail($user));

        // Assert email was sent
        Mail::assertSent(VerifyEmailMail::class, function ($mail) use ($user) {
            return $mail->user->id === $user->id;
        });
    }
}
