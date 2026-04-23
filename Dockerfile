# syntax=docker/dockerfile:1.4

# 1. Base PHP stage with FrankenPHP & Debian Bookworm
FROM dunglas/frankenphp:php8.3-bookworm AS base

# Install OS dependencies and PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    acl \
    file \
    gettext \
    git \
    curl \
    ca-certificates \
    gnupg \
    zip \
    unzip \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    bcmath \
    pcntl \
    opcache \
    redis

# Set working directory
WORKDIR /app

# 2. Composer stage
FROM base AS composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
# We skip scripts because Octane might not be installed yet
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# 3. Node.js stage for assets
FROM node:20-bookworm-slim AS node
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# 4. Final production stage
FROM base AS final

# Configure PHP for production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/php.ini $PHP_INI_DIR/conf.d/99-custom.ini

# Security: Create a non-root user for the application
# FrankenPHP uses www-data (UID 33) by default in many contexts, but we'll ensure it's ready.
RUN setcap CAP_NET_BIND_SERVICE=+eip /usr/local/bin/frankenphp
RUN chown -R www-data:www-data /app

# App environment
ENV APP_ENV=production
ENV APP_DEBUG=false
# Octane configuration
ENV OCTANE_SERVER=frankenphp
# Safety net: jika Octane gagal start, FrankenPHP Caddy default akan
# tetap mengarah ke /app/public/ (bukan root kosong yang menampilkan phpinfo)
ENV SERVER_ROOT=/app/public
ENV FRANKENPHP_CONFIG="worker /app/public/index.php"

# Copy code and dependencies
COPY --from=composer /app/vendor ./vendor
COPY --from=node /app/public/build ./public/build
COPY --chown=www-data:www-data . .

# Final composer autoloader optimization
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative

# Ensure permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Switch to non-root user
USER www-data

# Port 80 — matches Coolify/Traefik default routing
EXPOSE 80

# Entrypoint
COPY --chown=www-data:www-data docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
# Port 80 agar sesuai dengan Traefik default routing di Coolify
CMD ["php", "/app/artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=80"]
