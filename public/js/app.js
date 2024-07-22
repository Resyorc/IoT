document.addEventListener('alpine:init', () => {
    Alpine.store('sidebar', {
        full: false,
        active: 'dashboard',
        navOpen: false
    });
})
