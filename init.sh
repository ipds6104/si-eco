#!/bin/bash

# CAIKUE (SI-ECO) Project Smart Setup Script for Linux
PROJECT_NAME="CAIKUE"
FRESH=false

# Colors for output
CYAN='\033[0;36m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Parse arguments
for arg in "$@"; do
    if [ "$arg" == "--fresh" ] || [ "$arg" == "-f" ]; then
        FRESH=true
    fi
done

echo -e "${CYAN}Initialing $PROJECT_NAME Development Environment (Linux Version)...${NC}"

# 1. Environment File Check
if [ ! -f ".env" ]; then
    echo -e "${YELLOW}.env file not found. Creating from .env.example...${NC}"
    cp .env.example .env
fi

# 1a. Check for Local DB Profile
PROFILE_FLAG=""
if grep -q "USE_LOCAL_DB=true" .env; then
    echo -e "${CYAN}Local MySQL enabled via USE_LOCAL_DB=true${NC}"
    PROFILE_FLAG="--profile with-db"
    
    # Auto-update DB_HOST to 'db' if using local container
    if grep -q "DB_HOST=host.docker.internal" .env; then
        echo -e "${YELLOW}Updating DB_HOST to 'db' in .env...${NC}"
        sed -i 's/DB_HOST=host.docker.internal/DB_HOST=db/' .env
    fi

    # Auto-update DB_PASSWORD to 'root' if empty
    if grep -q "DB_PASSWORD=$" .env || grep -q "DB_PASSWORD=\"\"" .env; then
        echo -e "${YELLOW}Updating DB_PASSWORD to 'root' in .env...${NC}"
        sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=root/' .env
    fi

    # Auto-update APP_URL to 127.0.0.1 if it's localhost
    if grep -q "APP_URL=http://localhost" .env; then
        echo -e "${YELLOW}Updating APP_URL to 127.0.0.1 in .env...${NC}"
        sed -i 's|APP_URL=http://localhost|APP_URL=http://127.0.0.1|' .env
    fi
fi

# 1b. Restarting Containers for Safety
echo -e "${YELLOW}Restarting containers to ensure clean state...${NC}"
docker compose $PROFILE_FLAG down --remove-orphans

# 2. Start/Check Docker Containers
if [ "$FRESH" = true ]; then
    echo -e "${YELLOW}Force-rebuilding Docker containers...${NC}"
    docker compose $PROFILE_FLAG up -d --build --remove-orphans
else
    echo -e "${YELLOW}Ensuring Docker containers are running...${NC}"
    docker compose $PROFILE_FLAG up -d
fi

if [ $? -ne 0 ]; then
    echo -e "${RED}Failed to start Docker containers. Ensure Docker is running.${NC}"
    exit 1
fi

# 3. Wait briefly for services
echo -e "${YELLOW}Waiting for services to stabilize...${NC}"
sleep 5

# 4. Dependency Management (PHP)
if [ "$FRESH" = true ] || [ ! -d "vendor" ]; then
    echo -e "${YELLOW}Installing PHP dependencies...${NC}"
    docker compose exec app composer install
else
    echo -e "${GREEN}PHP dependencies already installed. Skipping...${NC}"
fi

# 5. Laravel Setup (Conditional)
if [ "$FRESH" = true ] || ! grep -q "APP_KEY=base64:" .env; then
    echo -e "${YELLOW}Generating Application Key...${NC}"
    docker compose exec app php artisan key:generate --ansi
else
    echo -e "${GREEN}Application Key already exists. Skipping...${NC}"
fi

# 6. Octane Checklist
if [ "$FRESH" = true ] || [ ! -f "config/octane.php" ]; then
    echo -e "${YELLOW}Setting up Laravel Octane...${NC}"
    docker compose exec app php artisan octane:install --server=frankenphp --no-interaction
fi

# 7. Database Migrations (Smart)
if [ "$PROFILE_FLAG" != "" ]; then
    echo -e "${YELLOW}Waiting for MySQL to be ready...${NC}"
    MAX_RETRIES=30
    COUNT=0
    while ! docker compose exec db mysqladmin ping -h"localhost" -u"root" -p"${DB_PASSWORD:-root}" --silent; do
        sleep 2
        COUNT=$((COUNT + 1))
        if [ $COUNT -ge $MAX_RETRIES ]; then
            echo -e "${RED}MySQL failed to start in time. Skipping migrations.${NC}"
            break
        fi
    done
fi

if [ "$FRESH" = true ]; then
    echo -e "${RED}Fresh migration and seeding (Destructive)...${NC}"
    docker compose exec app php artisan migrate:fresh --seed --no-interaction
else
    echo -e "${YELLOW}Running incremental migrations (Safe)...${NC}"
    docker compose exec app php artisan migrate --no-interaction
fi

# 7b. Storage Link (idempotent)
echo -e "${YELLOW}Ensuring storage symlink exists...${NC}"
docker compose exec app php artisan storage:link --no-interaction 2>/dev/null || true

# 8. Frontend Assets (Smarter)
if [ ! -d "node_modules" ] || [ "$FRESH" = true ]; then
    echo -e "${YELLOW}Installing frontend dependencies...${NC}"
    docker compose exec app npm install
elif [ "$PROFILE_FLAG" != "" ] && [ ! -d "node_modules/chokidar" ]; then
    echo -e "${YELLOW}Chokidar missing for Octane watch. Installing...${NC}"
    docker compose exec app npm install chokidar
fi

if [ "$FRESH" = true ]; then
    echo -e "${YELLOW}Building assets for production...${NC}"
    docker compose exec app npm run build
fi

echo -e ""
echo -e "${GREEN}Setup Complete!${NC}"
echo -e "----------------------------------------"
echo -e "${CYAN}App URL:    http://127.0.0.1:8100${NC}"
echo -e "${CYAN}Mail UI:   http://127.0.0.1:8180${NC}"
echo -e "${CYAN}MySQL Host: 127.0.0.1${NC}"
echo -e "----------------------------------------"
echo -e "To reset everything, run: ./init.sh --fresh"
echo -e "To see logs, run: docker compose logs -f app"
