// assets/js/form-fix.js
// Removes any demo / template form blockers

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', event => {
            // Stop other JS from blocking submission
            event.stopImmediatePropagation();
        }, true);
    });
});
