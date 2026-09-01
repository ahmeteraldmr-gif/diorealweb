<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Dioreal Diagnostic Tool</h2>";

try {
    echo "<p>1. Loading Autoloader...</p>";
    require __DIR__ . '/../vendor/autoload.php';

    echo "<p>2. Bootstrapping Laravel Application...</p>";
    $app = require __DIR__ . '/../bootstrap/app.php';
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    
    echo "<p>3. Testing Request Handling...</p>";
    $request = Illuminate\Http\Request::capture();
    $response = $kernel->handle($request);
    
    echo "<p>Status Code: " . $response->getStatusCode() . "</p>";
    echo "<div style='background:#f3f4f6; padding:15px; border-radius:8px;'>";
    echo "✔ Application bootstrapped without crashing!";
    echo "</div>";
} catch (\Throwable $e) {
    echo "<h3 style='color:red;'>❌ ERROR DETECTED:</h3>";
    echo "<p><b>Message:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><b>File:</b> " . htmlspecialchars($e->getFile()) . " on line " . $e->getLine() . "</p>";
    echo "<h4>Trace:</h4><pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

// Check recent log file entries
$logPath = __DIR__ . '/../storage/logs/laravel.log';
if (file_exists($logPath)) {
    echo "<h3>Recent Lines from storage/logs/laravel.log:</h3>";
    $lines = file($logPath);
    $lastLines = array_slice($lines, -30);
    echo "<pre style='background:#1e1e1e; color:#00ff00; padding:15px; overflow:auto; max-height:400px;'>" . htmlspecialchars(implode("", $lastLines)) . "</pre>";
} else {
    echo "<p>Log file storage/logs/laravel.log does not exist yet.</p>";
}
