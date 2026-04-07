// FundiMzii JavaScript functionality

class OfflineStorage {
    constructor() {
        this.storageKey = 'fundimzii_queue';
    }

    get() {
        const data = localStorage.getItem(this.storageKey);
        return data ? JSON.parse(data) : [];
    }

    save(queue) {
        localStorage.setItem(this.storageKey, JSON.stringify(queue));
    }

    add(payload) {
        const queue = this.get();
        queue.push({
            ...payload,
            timestamp: new Date().toISOString(),
        });
        this.save(queue);
    }

    removeAt(index) {
        const queue = this.get();
        queue.splice(index, 1);
        this.save(queue);
    }
}

const offlineStorage = new OfflineStorage();

function showNotification(message, type = 'info') {
    const container = document.querySelector('#app-alerts') || document.querySelector('.container-fluid');
    if (!container) {
        return;
    }

    const wrapper = document.createElement('div');
    wrapper.className = `alert alert-${type} alert-dismissible fade show`;
    wrapper.role = 'alert';
    wrapper.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    container.prepend(wrapper);
}

function serializeForm(form) {
    const formData = new FormData(form);
    const data = {};

    for (const [key, value] of formData.entries()) {
        if (value instanceof File) {
            if (value.name) {
                data[`${key}_filename`] = value.name;
            }
            continue;
        }

        data[key] = value;
    }

    return data;
}

async function syncOfflineData() {
    const queue = offlineStorage.get();

    if (!queue.length || !navigator.onLine) {
        return;
    }

    for (let index = 0; index < queue.length; index += 1) {
        const item = queue[index];

        try {
            const response = await fetch(item.action, {
                method: item.method || 'POST',
                headers: {
                    'Accept': 'text/html,application/xhtml+xml',
                    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new URLSearchParams(item.data).toString(),
                credentials: 'same-origin',
            });

            if (!response.ok) {
                throw new Error(`Sync failed with status ${response.status}`);
            }

            offlineStorage.removeAt(index);
            index -= 1;
        } catch (error) {
            console.error('FundiMzii sync error:', error);
            showNotification('Some offline records are still waiting to sync.', 'warning');
            return;
        }
    }

    showNotification('Offline records synced successfully.', 'success');
}

window.addEventListener('online', () => {
    showNotification('Connection restored. Syncing saved records...', 'success');
    syncOfflineData();
});

window.addEventListener('offline', () => {
    showNotification('You are offline. New form entries will be queued on this device.', 'warning');
});

document.addEventListener('DOMContentLoaded', () => {
    if (!navigator.onLine) {
        showNotification('Offline mode is active on this device.', 'warning');
    } else {
        syncOfflineData();
    }

    document.querySelectorAll('form[data-offline-form]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (navigator.onLine) {
                return;
            }

            event.preventDefault();
            const data = serializeForm(form);

            offlineStorage.add({
                action: form.action,
                method: (form.method || 'POST').toUpperCase(),
                data,
            });

            form.reset();
            showNotification('Form saved offline. Photo files will need to be reattached before final submission if they were not online.', 'warning');
        });
    });

    document.querySelectorAll('form[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            const message = form.getAttribute('data-confirm');
            if (!window.confirm(message)) {
                event.preventDefault();
            }
        });
    });
});
