// FundiMzii JavaScript functionality

// Offline data storage using localStorage
class OfflineStorage {
    constructor() {
        this.storageKey = 'fundimzii_queue';
    }

    add(action, data) {
        const queue = this.get();
        queue.push({
            action: action,
            data: data,
            timestamp: new Date().toISOString()
        });
        localStorage.setItem(this.storageKey, JSON.stringify(queue));
    }

    get() {
        const data = localStorage.getItem(this.storageKey);
        return data ? JSON.parse(data) : [];
    }

    clear() {
        localStorage.removeItem(this.storageKey);
    }

    isEmpty() {
        return this.get().length === 0;
    }
}

// Initialize offline storage
const offlineStorage = new OfflineStorage();

// Check online/offline status
window.addEventListener('online', function() {
    console.log('Connection restored!');
    showNotification('Connection restored! Syncing data...', 'success');
    syncOfflineData();
});

window.addEventListener('offline', function() {
    console.log('Connection lost! Using offline mode...');
    showNotification('Connection lost. Changes will sync when online.', 'warning');
});

// Show notification
function showNotification(message, type = 'info') {
    const alertClass = `alert-${type}`;
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    const container = document.querySelector('.container-fluid');
    if (container) {
        container.insertAdjacentHTML('afterbegin', alertHtml);
    }
}

// Form submission with offline support
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!navigator.onLine) {
            e.preventDefault();
            // Store form data for later sync
            const formData = new FormData(this);
            offlineStorage.add('form_submit', Object.fromEntries(formData));
            showNotification('Form saved offline. Will sync when connection is restored.', 'warning');
        }
    });
});

// Sync offline data when back online
function syncOfflineData() {
    const queue = offlineStorage.get();
    if (queue.length === 0) return;

    queue.forEach((item, index) => {
        setTimeout(() => {
            // You would implement actual sync logic here
            console.log('Syncing:', item);
            // After successful sync, remove from queue
            offlineStorage.clear();
            showNotification(`Synced ${queue.length} queued items`, 'success');
        }, index * 500);
    });
}

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-KE', {
        style: 'currency',
        currency: 'KES'
    }).format(amount);
}

// Confirmation dialogs
document.querySelectorAll('form[data-confirm]').forEach(form => {
    form.addEventListener('submit', function(e) {
        const message = this.getAttribute('data-confirm');
        if (!confirm(message)) {
            e.preventDefault();
        }
    });
});

// Print functionality
function printPage() {
    window.print();
}

// Initialize Bootstrap tooltips and popovers if used
document.addEventListener('DOMContentLoaded', function() {
    // Initialize any tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Format currency fields
    document.querySelectorAll('[data-currency]').forEach(el => {
        if (el.value) {
            el.value = formatCurrency(parseFloat(el.value));
        }
    });
});

// Search functionality with debounce
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Export data to JSON
function exportData() {
    const data = {
        clients: [],
        measurements: [],
        orders: [],
        exportDate: new Date().toISOString()
    };

    const dataStr = JSON.stringify(data, null, 2);
    const dataBlob = new Blob([dataStr], { type: 'application/json' });
    const url = URL.createObjectURL(dataBlob);
    const link = document.createElement('a');
    link.href = url;
    link.download = `fundimzii_backup_${new Date().getTime()}.json`;
    link.click();
}

// Check if online on page load
if (!navigator.onLine) {
    showNotification('Currently offline. Data will be synced when connection is restored.', 'warning');
}
