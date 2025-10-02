<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a verified test user for login testing
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'email_verified_at' => now(), // Already verified
        ]);

        // Create an unverified user for registration testing
        User::factory()->unverified()->create([
            'name' => 'Unverified User',
            'email' => 'unverified@example.com',
        ]);

        // Create additional test users
        User::factory(5)->create();

        // Create some unverified users for testing
        User::factory(3)->unverified()->create();

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📧 Test accounts created:');
        $this->command->info('   - test@example.com (verified - ready for OTP login)');
        $this->command->info('   - unverified@example.com (needs email verification)');
        $this->command->info('   - 5 additional verified users');
        $this->command->info('   - 3 additional unverified users');
    }
}
