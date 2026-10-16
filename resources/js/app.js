import './bootstrap';

// Mobile menu handler
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (btn && menu) {
        btn.addEventListener('click', () => {
            const isHidden = menu.classList.toggle('hidden');
            if (hamburgerIcon) hamburgerIcon.classList.toggle('hidden', !isHidden);
            if (closeIcon) closeIcon.classList.toggle('hidden', isHidden);
        });
    }
});

