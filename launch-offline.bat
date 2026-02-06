@echo off
REM Offline Game Launcher for Amara's Quest (Windows)

echo 🎮 Starting Amara's Quest - Offline Mode
echo ========================================

REM Check if node_modules exists
if not exist "node_modules" (
    echo 📦 Installing dependencies...
    call npm install
    echo ✅ Dependencies installed!
) else (
    echo ✅ Dependencies already installed
)

echo.
echo 🚀 Starting local server...
echo 📍 Game will be available at: http://localhost:8000
echo.
echo Press Ctrl+C to stop the server
echo.

python -m http.server 8000
