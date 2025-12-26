document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('ordersSearch');
    const table = document.getElementById('ordersTable');
    const rows = table ? table.querySelectorAll('tbody tr') : [];

    if (!searchInput || rows.length === 0) return;

    searchInput.addEventListener('input', function () {
        const term = this.value.trim().toLowerCase();

        rows.forEach(row => {
            // Extract all cell text (ignore "JD" in price)
            const text = Array.from(row.querySelectorAll('td'))
                .map(cell => (cell.textContent || '')
                    .replace(/JD/gi, '')   // Remove currency for number search
                    .replace(/\s+/g, ' ')  // Normalize whitespace
                    .trim()
                )
                .join(' ')
                .toLowerCase();

            row.style.display = text.includes(term) ? '' : 'none';
        });
    });
});