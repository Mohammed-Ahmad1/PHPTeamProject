// assets/js/main.js — 100% production, NO alerts
document.addEventListener('DOMContentLoaded', function () {
    // Auto-highlight active nav link
    const currentPage = window.location.pathname.split('/').pop();
    document.querySelectorAll('.nav-link').forEach(link => {
        const href = link.getAttribute('href');
        if (href && href === currentPage) {
            link.classList.add('active');
        }
    });

    // Show success toast (e.g., ?success=Added!)
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    if (success) {
        const toastHTML = `
            <div class="toast align-items-center text-bg-success border-0 show fade" 
                 role="alert" style="position: fixed; top: 15px; right: 15px; z-index: 1100;">
                <div class="d-flex">
                    <div class="toast-body">${success}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" 
                            data-bs-dismiss="toast"></button>
                </div>
            </div>`;
        document.body.insertAdjacentHTML('beforeend', toastHTML);
        const toastEl = document.querySelector('.toast');
        if (bootstrap.Toast) new bootstrap.Toast(toastEl, { delay: 3000 }).show();
    }
});