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

    /* ── INTERACTIVE MARQUEE SCROLL (MOBILE ONLY) ── */
    const initMarqueeScroll = () => {
        const containers = document.querySelectorAll('.marquee-container');
        
        containers.forEach(container => {
            const track = container.querySelector('.marquee-track');
            if (!track) return;
            
            // Detect touch capability
            const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
            if (!isTouchDevice) return; // Let desktop use native CSS marquee
            
            let speed = 0.8; // px per frame
            
            // Initialize scroll position in the middle for seamless two-way infinity
            const initScrollPosition = () => {
                const halfWidth = track.scrollWidth / 2;
                if (halfWidth > 200) {
                    container.scrollLeft = halfWidth;
                }
            };
            
            initScrollPosition();
            setTimeout(initScrollPosition, 500);
            window.addEventListener('load', initScrollPosition);

            // Infinite loop warp on scroll (supports native touch swipe and auto scroll)
            container.addEventListener('scroll', () => {
                const halfWidth = track.scrollWidth / 2;
                if (halfWidth <= 200) return; // Wait until track is fully loaded
                
                // Safe warp boundaries to prevent infinite loop event triggers
                if (container.scrollLeft >= halfWidth + 100) {
                    container.scrollLeft -= halfWidth;
                } else if (container.scrollLeft <= 50) {
                    container.scrollLeft += halfWidth;
                }
            });

            // Auto Scroll Step (Runs continuously, touch swipes naturally override it)
            const step = () => {
                container.scrollLeft += speed;
                requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        });
    };

    // Initialize interactive marquee
    initMarqueeScroll();
};

document.addEventListener('DOMContentLoaded', initHome);
