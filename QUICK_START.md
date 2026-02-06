# 🎮 Amara's Quest - Quick Start Guide

## ⚡ Fastest Way to Run Offline

### For Linux/Mac Users:
```bash
./launch-offline.sh
```

### For Windows Users:
```bash
launch-offline.bat
```

This will automatically:
1. ✅ Install dependencies (if needed)
2. ✅ Start the local server
3. ✅ Open the game at http://localhost:8000

---

## 📋 Manual Setup (If Scripts Don't Work)

### Step 1: Install Dependencies
```bash
npm install
```

### Step 2: Start the Server
```bash
python3 -m http.server 8000
```

### Step 3: Open in Browser
Visit: **http://localhost:8000**

---

## 🎮 Game Controls
| Key | Action |
|-----|--------|
| **W** | Move Forward |
| **A** | Move Left |
| **S** | Move Backward |
| **D** | Move Right |
| **Space** | Jump |
| **Mouse** | Rotate Camera |
| **F** | Attack |

---

## 🎯 Objective
Collect all 5 **Sunstone Fragments** while defeating Spirit Wisps to win!

---

## ✨ Features
- ✅ Complete offline gameplay
- ✅ No internet required
- ✅ Real-time 3D graphics
- ✅ Enemy AI with combat
- ✅ Score system
- ✅ Health & defeat conditions
- ✅ Multiple levels of challenge

---

## 🔧 Troubleshooting

| Problem | Solution |
|---------|----------|
| "Module not found" | Run `npm install` |
| CORS errors | Use HTTP server (don't open HTML directly) |
| Game looks broken | Check browser console (F12) |
| Dependencies won't install | Update Node.js to v14+ |

---

## 📦 What's Included

- **three.js** - 3D graphics engine (local)
- **tween.js** - Smooth animations (local)
- **Custom Controls** - Player movement & camera (local)
- **Zero External Dependencies** - Plays offline perfectly!

---

## 📁 Project Files
```
FundiMzii/
├── index.html              ← Game HTML
├── main.js                 ← Game entry point
├── game.js                 ← Core game logic
├── player.js               ← Player mechanics
├── world.js                ← Environment
├── enemy.js                ← Enemy AI
├── vfx.js                  ← Effects
├── rosieControls.js        ← Controls
├── package.json            ← Dependencies
├── node_modules/           ← Installed packages
├── launch-offline.sh       ← Linux/Mac launcher
├── launch-offline.bat      ← Windows launcher
├── OFFLINE_SETUP.md        ← Detailed setup
└── README.md               ← Full documentation
```

---

## 🚀 Next Steps
1. Run the launcher script
2. Wait for server to start
3. Open http://localhost:8000
4. Enjoy Amara's Quest! 🎉

**No internet. No streaming. Just pure offline gaming!**
