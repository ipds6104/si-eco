#!/bin/sh

# JANGAN gunakan set -e di sini!
# Jika migrasi/cache gagal (misal: DB belum siap), kita tetap HARUS
# menjalankan Octane agar FrankenPHP tidak jatuh ke mode phpinfo().

cd /app

# Initial setup for production
if [ "$APP_ENV" = "production" ]; then
    echo "🚀 Running in production mode..."

    # Run migrations (toleransi jika DB belum siap)
    echo "Running migrations..."
    php /app/artisan migrate --force --no-interaction 2>&1 || echo "⚠️  Migration failed (DB mungkin belum siap), skipping..."

    # Clear and Cache configurations (toleransi jika gagal)
    echo "Clearing and Caching config, routes, and views..."
    php /app/artisan config:clear 2>&1
    php /app/artisan view:clear 2>&1
    php /app/artisan optimize 2>&1 || echo "⚠️  Optimize failed, skipping..."
    php /app/artisan view:cache 2>&1 || echo "⚠️  View cache failed, skipping..."

    # Create storage symlink (idempotent)
    echo "Ensuring storage symlink exists..."
    php /app/artisan storage:link --no-interaction 2>&1 || echo "⚠️  Storage link failed, skipping..."

    echo "✅ Entrypoint setup complete. Starting application..."
fi

# 2. Development / Watch Mode Override
if [ "$WATCH" = "true" ]; then
    echo "🛠️  Starting in WATCH mode (Development)..."
    
    # Start Vite in background for asset hot reloading
    if [ -f "package.json" ]; then
        echo "Starting Vite (npm run dev)..."
        npm run dev -- --host 0.0.0.0 &
    fi

    # Start Octane with --watch
    echo "Starting Octane with --watch..."
    exec php artisan octane:start --server=frankenphp --host=0.0.0.0 --port=80 --admin-port=2019 --watch
fi

# Execute CMD (Octane start) — INI HARUS SELALU TERCAPAI
exec "$@"
