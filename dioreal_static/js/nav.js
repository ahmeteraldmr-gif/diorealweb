// ── NAV & MENU LOGIC ──
const initNav = () => {
    const mainNav = document.getElementById('mainNav');
    const hamb = document.getElementById('hamb');
    const fsMenu = document.getElementById('fsMenu');

    if (mainNav) {
        window.addEventListener('scroll', () => {
            mainNav.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });
    }

    if (hamb && fsMenu) {
        hamb.addEventListener('click', () => {
            hamb.classList.toggle('active');
            fsMenu.classList.toggle('active');
            document.body.style.overflow = fsMenu.classList.contains('active') ? 'hidden' : '';
        });

        fsMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
            hamb.classList.remove('active');
            fsMenu.classList.remove('active');
            document.body.style.overflow = '';
        }));
    }
};

document.addEventListener('DOMContentLoaded', initNav);
