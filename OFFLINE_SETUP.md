# Amara's Quest - Offline Setup Guide

## Prerequisites
- Node.js (v14 or higher)
- npm (comes with Node.js)
- Python 3 (for local server)

## Installation Steps

### 1. Install Dependencies
```bash
npm install
```

This will install:
- **three.js** - 3D graphics library
- **@tweenjs/tween.js** - Animation library
- **esbuild** - Module bundler (dev only)

### 2. Run the Game Offline

#### Option A: Using Python HTTP Server (Simplest)
```bash
python3 -m http.server 8000
```
Then open `http://localhost:8000` in your browser.

#### Option B: Using npm Scripts
```bash
npm run serve
```

#### Option C: Direct File Access
Simply open `index.html` in your browser (though some features may be limited due to CORS restrictions with ES modules).

### 3. Project Structure
```
FundiMzii/
├── index.html              # Main HTML file
├── main.js                 # Game entry point
├── game.js                 # Game logic
├── player.js               # Player class
├── world.js                # World/environment
├── enemy.js                # Enemy AI
├── vfx.js                  # Visual effects
├── rosieControls.js        # Player & camera controls
├── package.json            # Dependencies
├── node_modules/           # Installed packages (created by npm)
└── README.md               # This file
```

## What's Different From Online Version

✅ **All dependencies are now local:**
- Three.js bundled in `node_modules/three/`
- Tween.js bundled in `node_modules/@tweenjs/tween.js/`
- No CDN calls to external services

✅ **Removed unnecessary Rosebud platform scripts:**
- ChatManager
- ImageGenerator  
- ScriptsLoader
- ProgressLogger
- OGP

✅ **Custom rosieControls module:**
- Implemented locally with PlayerController and ThirdPersonCameraController

## No Internet Required
Once you've run `npm install`, the game can be played completely offline without any internet connection. The local server is optional - you can also open the HTML file directly in most modern browsers.

## Troubleshooting

**Issue:** Module not found errors
- Solution: Make sure you've run `npm install` first

**Issue:** CORS errors when opening HTML directly
- Solution: Use the Python HTTP server: `python3 -m http.server 8000`

**Issue:** Three.js shader files missing
- Solution: The server must be running from the project root directory

## Build for Production

To create an optimized bundled version:
```bash
npm run build
```
This creates a single `dist/bundle.js` file that can be deployed.

## Game Controls
- **WASD** - Move
- **Space** - Jump
- **Mouse** - Rotate camera
- **F** - Attack with Kora
- **Objective** - Collect all 5 Sunstone Fragments!

Enjoy Amara's Quest offline! 🎮
