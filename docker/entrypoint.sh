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

    # Cache configurations (toleransi jika gagal)
    echo "Caching config, routes, and views..."
    php /app/artisan optimize 2>&1 || echo "⚠️  Optimize failed, skipping..."
    php /app/artisan view:cache 2>&1 || echo "⚠️  View cache failed, skipping..."

    # Create storage symlink (idempotent)
    echo "Ensuring storage symlink exists..."
    php /app/artisan storage:link --no-interaction 2>&1 || echo "⚠️  Storage link failed, skipping..."

    echo "✅ Entrypoint setup complete. Starting application..."
fi

# Execute CMD (Octane start) — INI HARUS SELALU TERCAPAI
exec "$@"
