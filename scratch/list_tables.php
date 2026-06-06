<?php

$filePath = 'c:\xampp\htdocs\laravel\dcdhaka.srsibd.com-2-main\upms\almsgov_upms.sql';
$handle = fopen($filePath, 'r');
$tables = [];

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if (preg_match('/CREATE TABLE `([^`]+)`/', $line, $matches)) {
            $tables[] = $matches[1];
        }
    }
    fclose($handle);
}

echo "Found tables: " . implode(', ', $tables) . "\n";
