<?php
$logPath = 'storage/logs/laravel.log';
if (!file_exists($logPath)) {
    die("LOG_NOT_FOUND\n");
}

$lines = file($logPath);
$lastLines = array_slice($lines, -200);

$output = "";
foreach ($lastLines as $line) {
    $data = json_decode($line, true);
    if ($data && isset($data['message'])) {
        $output .= "LOG_ENTRY: " . $data['message'] . "\n";
    }
    else {
        if (stripos($line, 'error') !== false || stripos($line, 'exception') !== false) {
            $output .= "RAW_LOG: " . substr($line, 0, 500) . "...\n";
        }
    }
}
file_put_contents('parsed_errors.txt', $output);
echo "DONE\n";
