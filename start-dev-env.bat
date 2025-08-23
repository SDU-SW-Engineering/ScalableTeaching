@echo off
setlocal enabledelayedexpansion

echo Starting development environment...

echo.
echo 1. Starting Docker containers...
docker compose up -d

echo.
echo 2. Starting yarn watch in new terminal...
start "Yarn Watch" cmd /k "yarn watch"

echo.
echo 3. Starting Laravel scheduler in background...
start /b cmd /c "php artisan schedule:work > nul 2>&1"

echo.
echo 4. Starting Laravel queue worker in background...
start /b cmd /c "php artisan queue:work > nul 2>&1"

echo.
echo 5. Starting Laravel development server...
echo Press Ctrl+C to stop all services and close development environment
echo.
php artisan serve

echo.
echo Development server stopped. Cleaning up background processes...

echo Stopping Laravel background processes...
taskkill /f /im php.exe 2>nul

echo Stopping yarn watch...
taskkill /f /im node.exe 2>nul

echo Stopping Docker containers...
docker compose down

echo.
echo All development processes stopped.
pause
