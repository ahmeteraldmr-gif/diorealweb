<?php
$tempFiles = [
    'check_db.php',
    'check_users.php',
    'download_git.php',
    'patch_blades.php',
    'patch_controllers.php',
    'patch_frontend_location.php',
    'patch_frontend_seo.php',
    'patch_location_blades.php',
    'patch_location_controllers.php',
    'patch_page_controller.php',
    'rollback_server_db.php',
    'test_journal.php'
];

foreach ($tempFiles as $f) {
    $path = __DIR__ . '/../' . $f;
    if (file_exists($path)) {
        unlink($path);
        echo "Removed temporary file: " . $f . "\n";
    }
}
