#!/bin/bash
# OTP Authentication System Migration Script
# Run this in your target Laravel project root

echo "🚀 Starting OTP System Migration..."

# Create necessary directories
mkdir -p app/Livewire/Auth
mkdir -p app/Livewire/Components
mkdir -p app/Mail
mkdir -p resources/views/livewire/auth
mkdir -p resources/views/livewire/components
mkdir -p resources/views/auth
mkdir -p resources/views/emails

echo "📁 Directories created"

# Install Livewire if not already installed
composer require livewire/livewire

echo "📦 Livewire installed"

echo "✅ Directory structure ready!"
echo ""
echo "📋 Next steps:"
echo "1. Copy the files listed in the migration checklist"
echo "2. Run migrations: php artisan migrate"
echo "3. Update your .env file with mail settings"
echo "4. Clear caches: php artisan config:clear && php artisan route:clear"
echo "5. Test the system: php artisan db:seed"
echo ""
echo "🎯 Files to copy from source project:"
echo "   - All Livewire components"
echo "   - EmailOtp model"
echo "   - Mail classes"
echo "   - Views and templates"
echo "   - Database migrations"
echo "   - VerifyEmailController"
