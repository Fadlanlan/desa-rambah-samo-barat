<?php
$output = shell_exec('php artisan migrate:status 2>&1');
file_put_contents('migrate_status_capture.txt', $output);
echo "Captured.\n";
