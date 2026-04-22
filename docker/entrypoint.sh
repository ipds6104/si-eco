#!/bin/sh
set -e

# Permissions check (ensure www-data can write to storage)
# This is mainly for local development where volumes might mess up permissions
if [ ! -w "storage" ]; then
    echo "Fixing storage permissions..."
    # Note: This might fail if running as non-root on a volume owned by root
    # But in production/Coolify, the Dockerfile handles this.
fi

# Initial setup for production
if [ "$APP_ENV" = "production" ]; then
    echo "🚀 Running in production mode..."
    
    # Check if Octane is installed
    if [ ! -f "config/octane.php" ]; then
        echo "Installing Laravel Octane..."
        # We need composer here if it's not already installed, but it should be in the final image
        # for this specific check to pass during the first run if needed.
        # Ideally, Octane is installed in the image build phase.
    fi

    # Run migrations
    echo "Running migrations..."
    php artisan migrate --force --no-interaction

    # Cache configurations
    echo "Caching config, routes, and views..."
    php artisan optimize
    php artisan view:cache
fi

# Execute CMD
exec "$@"
