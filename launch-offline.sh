#!/bin/bash
# Offline Game Launcher for Amara's Quest

echo "🎮 Starting Amara's Quest - Offline Mode"
echo "========================================"

# Check if node_modules exists
if [ ! -d "node_modules" ]; then
    echo "📦 Installing dependencies..."
    npm install
    echo "✅ Dependencies installed!"
else
    echo "✅ Dependencies already installed"
fi

echo ""
echo "🚀 Starting local server..."
echo "📍 Game will be available at: http://localhost:8000"
echo ""
echo "Press Ctrl+C to stop the server"
echo ""

python3 -m http.server 8000
