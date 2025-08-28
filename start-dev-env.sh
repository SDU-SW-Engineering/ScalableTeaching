#!/bin/bash

echo "Starting development environment..."

# Function to cleanup background processes
cleanup() {
    echo
    echo "Development server stopped. Cleaning up background processes..."

    echo "Stopping Laravel background processes..."
    pkill -f "php artisan schedule:work" 2>/dev/null
    pkill -f "php artisan queue:work" 2>/dev/null

    echo "Stopping yarn watch..."
    pkill -f "yarn watch" 2>/dev/null

    echo "Stopping Docker containers..."
    docker compose down

    echo
    echo "All development processes stopped."
    exit 0
}

# Set up trap to call cleanup function when script receives SIGINT (Ctrl+C)
trap cleanup SIGINT SIGTERM

echo
echo "1. Starting Docker containers..."
docker compose up -d

echo
echo "2. Starting yarn watch in new terminal..."
# For macOS
if [[ "$OSTYPE" == "darwin"* ]]; then
    osascript -e 'tell app "Terminal" to do script "cd \"'$(pwd)'\" && yarn watch"'
# For Linux (requires gnome-terminal, xterm, or similar)
else
    if command -v gnome-terminal >/dev/null 2>&1; then
        gnome-terminal -- bash -c "cd '$(pwd)' && yarn watch; exec bash"
    elif command -v xterm >/dev/null 2>&1; then
        xterm -e "cd '$(pwd)' && yarn watch; exec bash" &
    elif command -v konsole >/dev/null 2>&1; then
        konsole -e bash -c "cd '$(pwd)' && yarn watch; exec bash" &
    else
        echo "Warning: Could not find a terminal emulator. Please run 'yarn watch' manually in another terminal."
    fi
fi

echo
echo "3. Starting Laravel scheduler in background..."
php artisan schedule:work >/dev/null 2>&1 &

echo
echo "4. Starting Laravel queue worker in background..."
php artisan queue:work >/dev/null 2>&1 &

echo
echo "5. Starting Laravel development server..."
echo "Press Ctrl+C to stop all services and close development environment"
echo

# Start the main server (this will block until Ctrl+C)
php artisan serve

# This line should never be reached due to the trap, but just in case
cleanup
