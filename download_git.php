<?php
$url = 'https://github.com/git-for-windows/git/releases/download/v2.41.0.windows.1/MinGit-2.41.0-64-bit.zip';
$zipFile = 'c:\\Users\\ahmet\\Desktop\\mingit.zip';
$extractTo = 'c:\\Users\\ahmet\\Desktop\\mingit';

echo "Downloading MinGit...\n";
$options = [
    'http' => [
        'method' => "GET",
        'header' => "User-Agent: Mozilla/5.0\r\n"
    ]
];
$context = stream_context_create($options);
$data = file_get_contents($url, false, $context);
if ($data === false) {
    die("Download failed.\n");
}
file_put_contents($zipFile, $data);
echo "Downloaded.\n";

echo "Extracting...\n";
$zip = new ZipArchive;
if ($zip->open($zipFile) === TRUE) {
    $zip->extractTo($extractTo);
    $zip->close();
    echo "Extracted.\n";
} else {
    echo "Extraction failed.\n";
}
