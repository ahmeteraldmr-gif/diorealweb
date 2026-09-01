<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Dioreal Diagnostic Tool</h2>";

// Print recent error log entries first
$logPath = __DIR__ . '/../storage/logs/laravel.log';
if (file_exists($logPath)) {
    echo "<h3>Recent Error Log Entries from storage/logs/laravel.log:</h3>";
    $lines = file($logPath);
    $lastLines = array_slice($lines, -150);
    $logContent = implode("", $lastLines);
    echo "<pre style='background:#1e1e1e; color:#00ff00; padding:15px; overflow:auto; max-height:500px; font-size:12px;'>" . htmlspecialchars($logContent) . "</pre>";
} else {
    echo "<p>Log file storage/logs/laravel.log does not exist yet.</p>";
}

try {
    echo "<p>Loading Autoloader & Application...</p>";
    require __DIR__ . '/../vendor/autoload.php';
    $app = require __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $request = Illuminate\Http\Request::capture();
    $response = $kernel->handle($request);
    echo "<p>Status Code: " . $response->getStatusCode() . "</p>";
} catch (\Throwable $e) {
    echo "<h3 style='color:red;'>❌ ERROR DETECTED DURING REQUEST HANDLING:</h3>";
    echo "<p><b>Message:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><b>File:</b> " . htmlspecialchars($e->getFile()) . " on line " . $e->getLine() . "</p>";
    echo "<h4>Trace:</h4><pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
