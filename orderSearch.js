document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('orderSearch');
    const tableRows = document.querySelectorAll('#recentOrdersTable tbody tr');

    // Optional: Add ID to table for clarity (not required, but good practice)
    // If you prefer not to add ID, we use relative DOM selection (done below)

    if (!searchInput) return; // Guard clause

    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.trim().toLowerCase();

        tableRows.forEach(row => {
            // Get text from all <td> cells in this row
            const cells = row.querySelectorAll('td');
            let rowText = '';
            cells.forEach(cell => {
                // Extract text (ignore "JD" prefix if present)
                let text = cell.textContent || cell.innerText;
                // Remove "JD" and extra spaces for better number search
                text = text.replace(/JD/gi, '').trim();
                rowText += ' ' + text;
            });

            // Show/hide row based on match
            if (rowText.toLowerCase().includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});