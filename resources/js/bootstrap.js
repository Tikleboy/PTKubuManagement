/**
 * Baseline client environment
 */
const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (token) {
    window.csrfToken = token;
}

