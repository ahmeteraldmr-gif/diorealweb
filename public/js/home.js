// ── HOME PAGE LOGIC ──
const initHome = () => {
    /* ── HERO SLIDER ── */
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 0) {
        let currentSlide = 0;
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 5000);
    }


    // ── DESTINATIONS TAB SWITCHING ──
    const tabs = document.querySelectorAll('.bt-tabs-nav li');
    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const targetType = tab.getAttribute('data-type');
                document.querySelectorAll('.yurtdisi-pane').forEach(pane => {
                    if (pane.id === `panel-${targetType}`) {
                        pane.style.display = '';
                    } else {
                        pane.style.display = 'none';
                    }
                });
            });
        });
    }

    // ── DYNAMIC LANGUAGE TOGGLE FOR DB FIELDS ──
    const handleDynamicLang = (lang) => {
        if (lang === 'tr') {
            document.querySelectorAll('.lang-tr-text').forEach(el => el.style.display = '');
            document.querySelectorAll('.lang-en-text').forEach(el => el.style.display = 'none');
        } else {
            document.querySelectorAll('.lang-tr-text').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.lang-en-text').forEach(el => el.style.display = '');
        }
    };

    // Check initial language
    const currentLang = localStorage.getItem('dioreal_lang') || 'tr';
    handleDynamicLang(currentLang);

    // Listen for custom langChanged event from central i18n
    document.addEventListener('langChanged', (e) => {
        handleDynamicLang(e.detail);
    });
};

document.addEventListener('DOMContentLoaded', initHome);
