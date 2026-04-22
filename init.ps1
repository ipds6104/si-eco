param (
    [switch]$Fresh
)

# SI-ECO Project Smart Setup Script
$projectName = "SI-ECO"
Write-Host ""
Write-Host "Initialing $projectName Development Environment..." -ForegroundColor Cyan

# 1. Environment File Check
if (-not (Test-Path ".env")) {
    Write-Host "env file not found. Creating from .env.example..." -ForegroundColor Yellow
    Copy-Item ".env.example" ".env"
}

# 2. Start/Check Docker Containers
if ($Fresh) {
    Write-Host "Force-rebuilding Docker containers..." -ForegroundColor Yellow
    docker compose up -d --build --remove-orphans
} else {
    Write-Host "Ensuring Docker containers are running..." -ForegroundColor Yellow
    docker compose up -d
}

if ($LASTEXITCODE -ne 0) {
    Write-Host "Failed to start Docker containers. Ensure Docker Desktop is running." -ForegroundColor Red
    exit $LASTEXITCODE
}

# 3. Wait briefly for services
Write-Host "Waiting for services to stabilize..." -ForegroundColor Yellow
Start-Sleep -Seconds 5

# 4. Dependency Management (Smarter)
if ($Fresh -or (-not (Test-Path "vendor"))) {
    Write-Host "Installing PHP dependencies..." -ForegroundColor Yellow
    docker compose exec app composer install
} else {
    Write-Host "PHP dependencies already installed. Skipping..." -ForegroundColor Green
}

# 5. Laravel Setup (Conditional)
$envContent = Get-Content ".env" -Raw
if ($Fresh -or $envContent -notmatch "APP_KEY=base64:[a-zA-Z0-9+/=]+") {
    Write-Host "Generating Application Key..." -ForegroundColor Yellow
    docker compose exec app php artisan key:generate --ansi
} else {
    Write-Host "Application Key already exists. Skipping..." -ForegroundColor Green
}

# 6. Octane Checklist
if ($Fresh -or (-not (Test-Path "config/octane.php"))) {
    Write-Host "Setting up Laravel Octane..." -ForegroundColor Yellow
    docker compose exec app php artisan octane:install --server=frankenphp --no-interaction
}

# 7. Database Migrations (Smart)
if ($Fresh) {
    Write-Host "Fresh migration and seeding (Destructive)..." -ForegroundColor Red
    docker compose exec app php artisan migrate:fresh --seed --no-interaction
} else {
    Write-Host "Running incremental migrations (Safe)..." -ForegroundColor Yellow
    docker compose exec app php artisan migrate --no-interaction
}

# 8. Frontend Assets (Smarter)
if ($Fresh -or (-not (Test-Path "node_modules"))) {
    Write-Host "Installing frontend dependencies..." -ForegroundColor Yellow
    docker compose exec app npm install
}

if ($Fresh) {
    Write-Host "Building assets for production..." -ForegroundColor Yellow
    docker compose exec app npm run build
}

Write-Host ""
Write-Host "Setup Complete!" -ForegroundColor Green
Write-Host "----------------------------------------"
Write-Host "App URL:    http://localhost:8100" -ForegroundColor Cyan
Write-Host "Mail UI:   http://localhost:8180" -ForegroundColor Cyan
Write-Host "MySQL Host: host.docker.internal" -ForegroundColor Cyan
Write-Host "----------------------------------------"
Write-Host "To reset everything, run: .\init.ps1 -Fresh"
Write-Host "To see logs, run: docker compose logs -f app"
