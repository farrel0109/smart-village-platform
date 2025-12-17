// No dependencies needed - all forms use standard POST
// This file is kept minimal for future enhancements

// API helper using native fetch (lighter than axios)
window.api = {
    get: (url) => fetch(url, {
        headers: { 'Accept': 'application/json' }
    }).then(r => r.json()),
    
    post: (url, data, csrfToken) => fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken || document.querySelector('meta[name="csrf-token"]')?.content
        },
        body: JSON.stringify(data)
    }).then(r => r.json())
};

// Scroll to top functionality
window.addEventListener('scroll', () => {
    const btn = document.getElementById('scroll-to-top');
    btn?.classList.toggle('hidden', window.pageYOffset <= 300);
});

// Auto-hide success messages
document.addEventListener('DOMContentLoaded', () => {
    const successMsg = document.querySelector('[data-auto-dismiss]');
    if (successMsg) {
        setTimeout(() => {
            successMsg.style.transition = 'opacity 0.3s';
            successMsg.style.opacity = '0';
            setTimeout(() => successMsg.remove(), 300);
        }, 5000);
    }
});
