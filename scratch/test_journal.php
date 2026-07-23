<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

try {
    $journal = App\Models\Journal::find(15);
    echo "Journal 15 in local DB: " . ($journal ? "FOUND (title: " . json_encode($journal->title) . ")" : "NOT FOUND") . "\n";
    
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::create('/journal/15', 'GET')
    );

    echo "Status Code: " . $response->getStatusCode() . "\n";
    if ($response->getStatusCode() === 500) {
        echo "CONTENT: \n" . substr($response->getContent(), 0, 2000) . "\n";
    } elseif ($response->isRedirection()) {
        echo "Redirect URL: " . $response->getTargetUrl() . "\n";
        $redirectUrl = parse_url($response->getTargetUrl(), PHP_URL_PATH);
        echo "Simulating request to redirect path: {$redirectUrl}\n";
        $req2 = Illuminate\Http\Request::create($redirectUrl, 'GET');
        $res2 = $kernel->handle($req2);
        echo "Redirect Status: " . $res2->getStatusCode() . "\n";
        if ($res2->getStatusCode() === 500) {
            echo "REDIRECT CONTENT: \n" . substr($res2->getContent(), 0, 2000) . "\n";
        }
    }
} catch (\Throwable $e) {
    echo "EXCEPTION: " . $e->getMessage() . "\n" . $e->getTraceAsString();
}
