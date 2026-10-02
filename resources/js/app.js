import Alpine from 'alpinejs';
import 'bootstrap-icons/font/bootstrap-icons.css';

window.Alpine = Alpine;

/* Theme Management */
function getSavedTheme() {
    return localStorage.getItem('theme') || 'light';
}

function applyTheme(theme) {
    document.documentElement.setAttribute(
        'data-bs-theme',
        theme
    );

    localStorage.setItem(
        'theme',
        theme
    );
}

window.toggleDashboardTheme = function () {

    const html = document.documentElement;
    const current = html.getAttribute('data-bs-theme') || getSavedTheme();
    const next = current === 'dark' ? 'light' : 'dark';

    applyTheme(next);
    updateThemeIcon(next);
};

window.updateThemeIcon = function (theme) {
    const icon = document.getElementById('themeIcon');
    if (!icon) {
        return;
    }

    icon.classList.remove('bi-moon-stars', 'bi-sun');
    icon.classList.add(theme === 'dark' ? 'bi-sun' : 'bi-moon-stars');
};

/* Load Saved Theme */
const savedTheme = localStorage.getItem('theme') || 'light';
document.documentElement.setAttribute('data-bs-theme', savedTheme);

/* Update Icon When Page Loads */

document.addEventListener(
    'DOMContentLoaded',
    function () {
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', theme);
        updateThemeIcon(theme);
    }
);

/* Alpine.js */

Alpine.start();