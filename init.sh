#!/bin/bash

# CAIKUE (SI-ECO) Project Smart Setup Script for Linux
PROJECT_NAME="CAIKUE"
FRESH=false
WATCH_MODE=false

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
    if [ "$arg" == "--watch" ] || [ "$arg" == "-w" ]; then
        WATCH_MODE=true
    fi
done

# Compose Files
COMPOSE_BASE="-f docker-compose.yml -f docker-compose.dev.yml"

echo -e "${CYAN}Initializing $PROJECT_NAME Development Environment...${NC}"

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
echo -e "${YELLOW}Restarting containers...${NC}"
docker compose $COMPOSE_BASE $PROFILE_FLAG down --remove-orphans

# 2. Start Docker Containers
if [ "$WATCH_MODE" = true ]; then
    echo -e "${YELLOW}Starting in WATCH (Hot Reload) mode...${NC}"
    WATCH=true docker compose $COMPOSE_BASE $PROFILE_FLAG up -d
else
    if [ "$FRESH" = true ]; then
        echo -e "${YELLOW}Force-rebuilding Docker containers...${NC}"
        docker compose $COMPOSE_BASE $PROFILE_FLAG up -d --build --remove-orphans
    else
        echo -e "${YELLOW}Ensuring Docker containers are running...${NC}"
        docker compose $COMPOSE_BASE $PROFILE_FLAG up -d
    fi
fi

if [ $? -ne 0 ]; then
    echo -e "${RED}Failed to start Docker containers.${NC}"
    exit 1
fi

# 3. Wait for services
echo -e "${YELLOW}Waiting for services to stabilize...${NC}"
sleep 5

# 4. PHP Dependencies
if [ "$FRESH" = true ] || [ ! -d "vendor" ]; then
    echo -e "${YELLOW}Installing PHP dependencies...${NC}"
    docker compose $COMPOSE_BASE exec app composer install
else
    echo -e "${GREEN}PHP dependencies already installed.${NC}"
fi

# 5. Laravel Setup
if [ "$FRESH" = true ] || ! grep -q "APP_KEY=base64:" .env; then
    echo -e "${YELLOW}Generating Application Key...${NC}"
    docker compose $COMPOSE_BASE exec app php artisan key:generate --ansi
fi

# 6. Octane Setup
if [ "$FRESH" = true ] || [ ! -f "config/octane.php" ]; then
    echo -e "${YELLOW}Setting up Laravel Octane...${NC}"
    docker compose $COMPOSE_BASE exec app php artisan octane:install --server=frankenphp --no-interaction
fi

# 7. Database Migrations
if [ "$PROFILE_FLAG" != "" ]; then
    echo -e "${YELLOW}Waiting for MySQL...${NC}"
    MAX_RETRIES=30
    COUNT=0
    while ! docker compose $COMPOSE_BASE exec db mysqladmin ping -h"localhost" -u"root" -p"root" --silent; do
        sleep 2
        COUNT=$((COUNT + 1))
        if [ $COUNT -ge $MAX_RETRIES ]; then break; fi
    done
fi

if [ "$FRESH" = true ]; then
    echo -e "${RED}Fresh migration and seeding...${NC}"
    docker compose $COMPOSE_BASE exec app php artisan migrate:fresh --seed --no-interaction
else
    echo -e "${YELLOW}Running migrations...${NC}"
    docker compose $COMPOSE_BASE exec app php artisan migrate --no-interaction
fi

# 7b. Storage Link
docker compose $COMPOSE_BASE exec app php artisan storage:link --no-interaction 2>/dev/null || true

# 8. Frontend Assets
if [ ! -d "node_modules" ] || [ "$FRESH" = true ]; then
    echo -e "${YELLOW}Installing frontend dependencies...${NC}"
    docker compose $COMPOSE_BASE exec app npm install
elif [ "$WATCH_MODE" = true ] && [ ! -d "node_modules/chokidar" ]; then
    echo -e "${YELLOW}Installing chokidar for watch mode...${NC}"
    docker compose $COMPOSE_BASE exec app npm install chokidar
fi

if [ "$FRESH" = true ]; then
    echo -e "${YELLOW}Building assets...${NC}"
    docker compose $COMPOSE_BASE exec app npm run build
fi

echo -e ""
echo -e "${GREEN}Setup Complete!${NC}"
echo -e "----------------------------------------"
echo -e "${CYAN}App URL:    http://127.0.0.1:8100${NC}"
echo -e "${CYAN}Mail UI:   http://127.0.0.1:8180${NC}"
echo -e "----------------------------------------"
echo -e "To reset: ./init.sh --fresh"
echo -e "To watch: ./init.sh --watch"

if [ "$WATCH_MODE" = true ]; then
    echo -e ""
    echo -e "${YELLOW}Attaching logs for Hot Reload (Ctrl+C to stop)...${NC}"
    docker compose $COMPOSE_BASE logs -f app
fi
