<?php
/**
 * Inject inline failproof lang-tab script into every admin blade with lang-tab buttons.
 * Skips layouts/app.blade.php (it's the layout, not a form page).
 * Skips files already patched.
 */

$inlineScript = <<<'SCRIPT'

    <script>
        /* ── INLINE LANG TAB: Failproof tab switcher, no external deps ── */
        (function() {
            function doSwitchTab(lang) {
                document.querySelectorAll('.lang-tab').forEach(function(tab) {
                    if (tab.getAttribute('data-lang') === lang) {
                        tab.classList.add('active');
                        tab.style.cssText = 'color:#c4a47c!important;border-bottom-color:#c4a47c!important;';
                    } else {
                        tab.classList.remove('active');
                        tab.style.cssText = 'color:#94a3b8;border-bottom-color:transparent;';
                    }
                });
                document.querySelectorAll('.lang-pane').forEach(function(pane) {
                    if (pane.getAttribute('data-lang') === lang) {
                        pane.style.cssText = 'display:block!important;visibility:visible!important;opacity:1!important;';
                        pane.classList.add('active');
                    } else {
                        pane.style.cssText = 'display:none!important;visibility:hidden!important;opacity:0!important;';
                        pane.classList.remove('active');
                    }
                });
            }
            window.switchLanguageTab = doSwitchTab;
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.lang-tab').forEach(function(btn) {
                    ['click','touchend'].forEach(function(evt) {
                        btn.addEventListener(evt, function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            doSwitchTab(this.getAttribute('data-lang'));
                        });
                    });
                });
            });
        })();
    </script>
SCRIPT;

$files = [
    __DIR__ . '/../resources/views/admin/destinations/create.blade.php',
    __DIR__ . '/../resources/views/admin/destinations/edit.blade.php',
    __DIR__ . '/../resources/views/admin/events/create.blade.php',
    __DIR__ . '/../resources/views/admin/events/edit.blade.php',
    __DIR__ . '/../resources/views/admin/guides/create.blade.php',
    __DIR__ . '/../resources/views/admin/guides/edit.blade.php',
    __DIR__ . '/../resources/views/admin/hotels/create.blade.php',
    __DIR__ . '/../resources/views/admin/hotels/edit.blade.php',
    __DIR__ . '/../resources/views/admin/journals/create.blade.php',
    __DIR__ . '/../resources/views/admin/journals/edit.blade.php',
    __DIR__ . '/../resources/views/admin/restaurants/edit.blade.php',
    __DIR__ . '/../resources/views/admin/yachts/create.blade.php',
    __DIR__ . '/../resources/views/admin/yachts/edit.blade.php',
    __DIR__ . '/../resources/views/admin/settings.blade.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        echo "SKIP (not found): $file\n";
        continue;
    }
    $content = file_get_contents($file);
    if (strpos($content, 'INLINE LANG TAB') !== false) {
        echo "SKIP (already patched): " . basename($file) . "\n";
        continue;
    }
    // Insert just before @endsection
    $patched = str_replace('@endsection', $inlineScript . "\n@endsection", $content);
    if ($patched === $content) {
        echo "SKIP (no @endsection): " . basename($file) . "\n";
        continue;
    }
    file_put_contents($file, $patched);
    echo "PATCHED: " . basename($file) . "\n";
}
echo "Done.\n";
