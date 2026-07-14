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

    // Language Switchers
    document.querySelectorAll('#lang-en, #lang-en-fs').forEach(btn =>
        btn.addEventListener('click', () => { updateLang('en'); document.dispatchEvent(new CustomEvent('langChanged', { detail: 'en' })); })
    );
    document.querySelectorAll('#lang-tr, #lang-tr-fs').forEach(btn =>
        btn.addEventListener('click', () => { updateLang('tr'); document.dispatchEvent(new CustomEvent('langChanged', { detail: 'tr' })); })
    );

    // Initial Language Load
    const savedLang = localStorage.getItem('dioreal_lang') || 'tr';
    updateLang(savedLang);
};

document.addEventListener('DOMContentLoaded', initNav);
