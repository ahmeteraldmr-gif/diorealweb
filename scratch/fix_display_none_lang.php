<?php
$viewsDir = __DIR__ . '/../resources/views';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        
        // Remove style="display:none;" or style="display: none;" from lang-en-text / lang-text-en
        $newContent = preg_replace('/(class=["\'][^"\']*\blang-(?:en-text|text-en)\b[^"\']*["\'])\s*style=["\']display:\s*none;?["\']/i', '$1', $content);
        $newContent = preg_replace('/style=["\']display:\s*none;?["\']\s*(class=["\'][^"\']*\blang-(?:en-text|text-en)\b[^"\']*["\'])/i', '$1', $newContent);

        if ($newContent !== $content) {
            file_put_contents($file->getPathname(), $newContent);
            echo "✔ Fixed display:none in " . $file->getFilename() . "\n";
        }
    }
}
echo "Done checking all Blade views.\n";
