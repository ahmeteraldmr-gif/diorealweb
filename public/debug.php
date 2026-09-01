<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Dioreal Diagnostic Tool - Revealing 500 Exception</h2>";

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $request = Illuminate\Http\Request::capture();
    $response = $kernel->handle($request);
    
    echo "<p><b>HTTP Response Status Code:</b> " . $response->getStatusCode() . "</p>";
    
    if (isset($response->exception) && $response->exception) {
        $e = $response->exception;
        echo "<h3 style='color:red;'>❌ LAREVEL CAUGHT EXCEPTION:</h3>";
        echo "<p><b>Class:</b> " . get_class($e) . "</p>";
        echo "<p><b>Message:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p><b>File:</b> " . htmlspecialchars($e->getFile()) . " on line " . $e->getLine() . "</p>";
        echo "<h4>Trace:</h4><pre style='background:#1e1e1e; color:#ff6b6b; padding:15px; overflow:auto; max-height:400px; font-size:11px;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    } else {
        echo "<p>No exception attached to response.</p>";
    }
} catch (\Throwable $e) {
    echo "<h3 style='color:red;'>❌ UNCAUGHT EXCEPTION:</h3>";
    echo "<p><b>Message:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><b>File:</b> " . htmlspecialchars($e->getFile()) . " on line " . $e->getLine() . "</p>";
    echo "<h4>Trace:</h4><pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
