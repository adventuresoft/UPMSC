<?php
/**
 * Non-destructive Database Merge Script
 * This script reads a SQL dump and merges it into the local 'upmsc' database.
 * It uses CREATE TABLE IF NOT EXISTS and INSERT IGNORE INTO to avoid deleting data.
 */

$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '';
$db_name = 'upmsc';

$sql_file = 'c:\xampp\htdocs\laravel\dcdhaka.srsibd.com-2-main\upms\almsgov_upms.sql';

// 1. Create backup
$backup_file = 'c:\xampp\htdocs\laravel\dcdhaka.srsibd.com-2-main\upms\scratch\upmsc_backup_' . time() . '.sql';
echo "Creating backup to $backup_file...\n";
// Attempt to use mysqldump, but don't fail if it doesn't exist
@exec("mysqldump -h $db_host -u $db_user $db_name > \"$backup_file\"");
mysqli_report(MYSQLI_REPORT_OFF);

// 2. Open connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// 3. Process SQL file
$handle = fopen($sql_file, 'r');
if (!$handle) {
    die("Could not open SQL file: $sql_file\n");
}

echo "Merging database contents...\n";
$current_query = '';
$success_count = 0;
$error_count = 0;

while (($line = fgets($handle)) !== false) {
    // Skip comments and empty lines
    $trimmed = trim($line);
    if ($trimmed == '' || strpos($trimmed, '--') === 0 || strpos($trimmed, '/*') === 0 || strpos($trimmed, '#') === 0) {
        continue;
    }

    $current_query .= $line;

    // Check if the query is finished (ends with ;)
    if (substr($trimmed, -1) == ';') {
        $query = trim($current_query);
        $current_query = '';

        // Non-destructive transformations
        if (stripos($query, 'CREATE TABLE') === 0) {
            $query = preg_replace('/CREATE TABLE/i', 'CREATE TABLE IF NOT EXISTS', $query, 1);
        } elseif (stripos($query, 'INSERT INTO') === 0) {
            $query = preg_replace('/INSERT INTO/i', 'INSERT IGNORE INTO', $query, 1);
        } elseif (stripos($query, 'DROP TABLE') === 0 || stripos($query, 'TRUNCATE') === 0) {
            // Skip destructive commands entirely
            continue;
        }

        try {
            if ($conn->query($query)) {
                $success_count++;
            } else {
                $error_count++;
            }
        } catch (\Exception $e) {
            // Ignore errors like "Multiple primary key" or "Duplicate column"
            $error_count++;
        }
    }
}

fclose($handle);
$conn->close();

echo "\nMerge completed.\n";
echo "Total queries executed successfully: $success_count\n";
echo "Total queries failed/ignored: $error_count\n";
echo "Backup created (if mysqldump available): $backup_file\n";
