import * as THREE from 'three';

export class PlayerController {
    constructor(model, options = {}) {
        this.model = model;
        this.moveSpeed = options.moveSpeed || 6;
        this.jumpForce = options.jumpForce || 12;
        this.gravity = options.gravity || 30;
        this.groundLevel = options.groundLevel || 0;
        
        this.velocity = new THREE.Vector3();
        this.isJumping = false;
        this.moveDirection = new THREE.Vector3();
        
        this.keys = {};
        this.setupInput();
    }

    setupInput() {
        window.addEventListener('keydown', (e) => {
            this.keys[e.code] = true;
        });
        window.addEventListener('keyup', (e) => {
            this.keys[e.code] = false;
        });
    }

    update(deltaTime, cameraRotation) {
        // Process movement input
        this.moveDirection.set(0, 0, 0);
        
        if (this.keys['KeyW']) this.moveDirection.z -= 1;
        if (this.keys['KeyS']) this.moveDirection.z += 1;
        if (this.keys['KeyA']) this.moveDirection.x -= 1;
        if (this.keys['KeyD']) this.moveDirection.x += 1;

        // Normalize and apply camera rotation to movement
        if (this.moveDirection.length() > 0) {
            this.moveDirection.normalize();
            
            // Rotate movement based on camera angle
            const cameraAngle = cameraRotation || 0;
            const x = this.moveDirection.x * Math.cos(cameraAngle) - this.moveDirection.z * Math.sin(cameraAngle);
            const z = this.moveDirection.x * Math.sin(cameraAngle) + this.moveDirection.z * Math.cos(cameraAngle);
            this.moveDirection.set(x, 0, z);
            
            this.moveDirection.multiplyScalar(this.moveSpeed);
        }

        // Apply movement to position
        this.model.position.x += this.moveDirection.x * deltaTime;
        this.model.position.z += this.moveDirection.z * deltaTime;

        // Gravity and jumping
        if (this.model.position.y > this.groundLevel) {
            this.velocity.y -= this.gravity * deltaTime;
            this.isJumping = true;
        } else {
            this.velocity.y = 0;
            this.isJumping = false;
            
            // Jump input
            if (this.keys['Space']) {
                this.velocity.y = this.jumpForce;
                this.keys['Space'] = false;
            }
        }

        // Apply vertical velocity
        this.model.position.y += this.velocity.y * deltaTime;
    }
}

export class ThirdPersonCameraController {
    constructor(camera, target, domElement, options = {}) {
        this.camera = camera;
        this.target = target;
        this.domElement = domElement;
        this.distance = options.distance || 6;
        this.height = options.height || 2.5;
        this.rotationSpeed = options.rotationSpeed || 0.005;
        
        this.horizontalAngle = 0;
        this.verticalAngle = Math.PI / 6; // 30 degrees
        this.mouseDown = false;
        this.lastMouseX = 0;
        this.lastMouseY = 0;
        
        this.setupInput();
    }

    setupInput() {
        this.domElement.addEventListener('mousedown', (e) => {
            this.mouseDown = true;
            this.lastMouseX = e.clientX;
            this.lastMouseY = e.clientY;
        });

        this.domElement.addEventListener('mousemove', (e) => {
            if (this.mouseDown) {
                const deltaX = e.clientX - this.lastMouseX;
                const deltaY = e.clientY - this.lastMouseY;
                
                this.horizontalAngle += deltaX * this.rotationSpeed;
                this.verticalAngle -= deltaY * this.rotationSpeed;
                
                // Clamp vertical angle
                this.verticalAngle = Math.max(-Math.PI / 2, Math.min(Math.PI / 2, this.verticalAngle));
                
                this.lastMouseX = e.clientX;
                this.lastMouseY = e.clientY;
            }
        });

        this.domElement.addEventListener('mouseup', () => {
            this.mouseDown = false;
        });
    }

    update() {
        // Calculate camera position
        const targetPos = this.target.position;
        const cameraPos = new THREE.Vector3();
        
        cameraPos.x = targetPos.x + Math.sin(this.horizontalAngle) * Math.cos(this.verticalAngle) * this.distance;
        cameraPos.y = targetPos.y + this.height + Math.sin(this.verticalAngle) * this.distance;
        cameraPos.z = targetPos.z + Math.cos(this.horizontalAngle) * Math.cos(this.verticalAngle) * this.distance;
        
        this.camera.position.copy(cameraPos);
        this.camera.lookAt(targetPos.x, targetPos.y + this.height * 0.5, targetPos.z);
        
        // Orient player to face camera direction
        this.target.rotation.y = -this.horizontalAngle + Math.PI;

        return this.horizontalAngle;
    }
}
