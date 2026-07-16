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

    /* ── INTERACTIVE MARQUEE SCROLL (MOBILE & DESKTOP) ── */
    const initMarqueeScroll = () => {
        const containers = document.querySelectorAll('.marquee-container');
        
        containers.forEach(container => {
            const track = container.querySelector('.marquee-track');
            if (!track) return;
            
            // Dynamically clone to ensure exactly 3 copies for seamless infinite scroll on wide screens
            const originalContent = container.querySelector('.marquee-content');
            if (originalContent) {
                track.innerHTML = '';
                
                const copy1 = originalContent.cloneNode(true);
                copy1.removeAttribute('aria-hidden');
                
                const copy2 = originalContent.cloneNode(true);
                copy2.setAttribute('aria-hidden', 'true');
                
                const copy3 = originalContent.cloneNode(true);
                copy3.setAttribute('aria-hidden', 'true');
                
                track.appendChild(copy1);
                track.appendChild(copy2);
                track.appendChild(copy3);
            }
            
            let currentX = 0;
            let speed = 0.8; // px per frame
            let isPaused = false;
            let resumeTimeout = null;
            
            let startTouchX = 0;
            let startTranslateX = 0;
            let isDragging = false;

            // Disable CSS animation entirely so JS controls the translation
            track.style.animation = 'none';

            // Auto-scroll loop
            const step = () => {
                if (!isPaused && !isDragging) {
                    const oneCopyWidth = track.scrollWidth / 3;
                    if (oneCopyWidth > 0) {
                        currentX -= speed;
                        if (currentX <= -oneCopyWidth) {
                            currentX += oneCopyWidth;
                        }
                        track.style.transform = `translateX(${currentX}px)`;
                    }
                }
                requestAnimationFrame(step);
            };
            requestAnimationFrame(step);

            const pauseScroll = () => {
                isPaused = true;
                if (resumeTimeout) clearTimeout(resumeTimeout);
            };

            const resumeScroll = () => {
                if (resumeTimeout) clearTimeout(resumeTimeout);
                resumeTimeout = setTimeout(() => {
                    isPaused = false;
                }, 2000); // Resume auto scroll after 2 seconds
            };

            // Touch events for Mobile
            container.addEventListener('touchstart', (e) => {
                isDragging = true;
                pauseScroll();
                startTouchX = e.touches[0].clientX;
                startTranslateX = currentX;
            }, { passive: true });

            container.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                const deltaX = e.touches[0].clientX - startTouchX;
                const oneCopyWidth = track.scrollWidth / 3;
                if (oneCopyWidth === 0) return;

                currentX = startTranslateX + deltaX;

                // Loop warp boundaries
                if (currentX <= -oneCopyWidth) {
                    currentX += oneCopyWidth;
                    startTranslateX += oneCopyWidth;
                    startTouchX = e.touches[0].clientX;
                } else if (currentX > 0) {
                    currentX -= oneCopyWidth;
                    startTranslateX -= oneCopyWidth;
                    startTouchX = e.touches[0].clientX;
                }

                track.style.transform = `translateX(${currentX}px)`;
            }, { passive: true });

            container.addEventListener('touchend', () => {
                isDragging = false;
                resumeScroll();
            }, { passive: true });

            // Mouse events for Desktop drag
            container.addEventListener('mousedown', (e) => {
                isDragging = true;
                pauseScroll();
                startTouchX = e.clientX;
                startTranslateX = currentX;
                container.style.cursor = 'grabbing';
            });

            container.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                const deltaX = e.clientX - startTouchX;
                const oneCopyWidth = track.scrollWidth / 3;
                if (oneCopyWidth === 0) return;

                currentX = startTranslateX + deltaX;

                // Loop warp boundaries
                if (currentX <= -oneCopyWidth) {
                    currentX += oneCopyWidth;
                    startTranslateX += oneCopyWidth;
                    startTouchX = e.clientX;
                } else if (currentX > 0) {
                    currentX -= oneCopyWidth;
                    startTranslateX -= oneCopyWidth;
                    startTouchX = e.clientX;
                }

                track.style.transform = `translateX(${currentX}px)`;
            });

            container.addEventListener('mouseup', () => {
                isDragging = false;
                container.style.cursor = 'grab';
                resumeScroll();
            });

            container.addEventListener('mouseleave', () => {
                if (isDragging) {
                    isDragging = false;
                    container.style.cursor = 'grab';
                    resumeScroll();
                }
            });
        });
    };

    // Initialize interactive marquee
    initMarqueeScroll();
};

document.addEventListener('DOMContentLoaded', initHome);
