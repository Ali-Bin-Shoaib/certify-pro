#!/bin/bash

# Certify Pro Deployment Script
echo "🚀 Starting deployment process..."

# Check if .env exists
if [ ! -f .env ]; then
    echo "❌ .env file not found. Please create one from .env.example"
    exit 1
fi

# Install dependencies
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader

# Generate application key if not set
if ! grep -q "APP_KEY=" .env || grep -q "APP_KEY=$" .env; then
    echo "🔑 Generating application key..."
    php artisan key:generate
fi

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

# Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment preparation complete!"
echo ""
echo "Next steps:"
echo "1. Push to your Git repository"
echo "2. Deploy to your chosen platform (Vercel, Heroku, Railway, etc.)"
echo "3. Set environment variables on your hosting platform"
echo "4. Configure your database"
echo ""
echo "For detailed instructions, see DEPLOYMENT.md"
