<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EmailOtp;
use Illuminate\Database\Seeder;

class OtpTestSeeder extends Seeder
{
    /**
     * Run the database seeds for OTP testing scenarios.
     */
    public function run(): void
    {
        $this->command->info('🔑 Seeding OTP test data...');

        // Clean up any existing OTP records
        EmailOtp::truncate();

        // Create test users for different scenarios
        $verifiedUser = User::factory()->create([
            'name' => 'OTP Test User',
            'email' => 'otp@example.com',
            'email_verified_at' => now(),
        ]);

        $unverifiedUser = User::factory()->unverified()->create([
            'name' => 'Pending Verification',
            'email' => 'pending@example.com',
        ]);

        // Create some sample OTP records for testing (normally these would be generated dynamically)
        // Note: In production, OTPs should only be generated when requested
        
        $this->command->info('✅ OTP test data seeded successfully!');
        $this->command->info('📧 Test accounts for OTP:');
        $this->command->info('   - otp@example.com (verified - ready for OTP login)');
        $this->command->info('   - pending@example.com (unverified - needs email verification first)');
        $this->command->info('');
        $this->command->info('🧪 To test OTP login:');
        $this->command->info('   1. Go to /login');
        $this->command->info('   2. Enter: otp@example.com');
        $this->command->info('   3. Check your email for the OTP code');
        $this->command->info('   4. Enter the 6-digit code to login');
    }
}
