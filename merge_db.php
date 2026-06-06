<?php
/**
 * Safe Database Merger
 * Reads almsgov_upms.sql and imports only INSERT data into local 'upmsc' DB
 * Uses INSERT IGNORE so existing local data is NEVER overwritten
 */

$sqlFile  = __DIR__ . '/clmsbd_upmsc.sql';
$dbHost   = '127.0.0.1';
$dbName   = 'upmsc';
$dbUser   = 'root';
$dbPass   = '';

echo "=== Safe DB Merger ===\n";
echo "Reading: $sqlFile\n";
echo "Target DB: $dbName\n\n";

// Connect
$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
]);
$pdo->exec("SET FOREIGN_KEY_CHECKS=0");
$pdo->exec("SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO'");

echo "Connected to database successfully.\n\n";

// Read file line by line and collect INSERT statements
$handle = fopen($sqlFile, 'r');
if (!$handle) {
    die("ERROR: Cannot open $sqlFile\n");
}

$insertCount  = 0;
$skipCount    = 0;
$errorCount   = 0;
$currentInsert = '';

echo "Processing INSERT statements...\n";

while (($line = fgets($handle)) !== false) {
    $trimmed = trim($line);

    // Skip comments, empty lines, CREATE TABLE, DROP TABLE, ALTER TABLE, LOCK, UNLOCK, etc.
    if (
        empty($trimmed) ||
        strpos($trimmed, '--') === 0 ||
        strpos($trimmed, '/*') === 0 ||
        strpos($trimmed, 'CREATE TABLE') === 0 ||
        strpos($trimmed, 'DROP TABLE') === 0 ||
        strpos($trimmed, 'ALTER TABLE') === 0 ||
        strpos($trimmed, 'LOCK TABLES') === 0 ||
        strpos($trimmed, 'UNLOCK TABLES') === 0 ||
        strpos($trimmed, 'KEY ') === 0 ||
        strpos($trimmed, 'PRIMARY KEY') === 0 ||
        strpos($trimmed, 'UNIQUE KEY') === 0 ||
        strpos($trimmed, 'CONSTRAINT') === 0 ||
        strpos($trimmed, 'SET SQL_MODE') === 0 ||
        strpos($trimmed, 'SET time_zone') === 0 ||
        strpos($trimmed, 'SET @OLD') === 0 ||
        strpos($trimmed, 'SET CHARACTER') === 0 ||
        strpos($trimmed, 'START TRANSACTION') === 0 ||
        strpos($trimmed, 'COMMIT') === 0 ||
        strpos($trimmed, '/*!') === 0
    ) {
        // If we have a partial INSERT being built, skip it when we hit non-INSERT
        if (!empty($currentInsert) && strpos($currentInsert, 'INSERT') !== 0) {
            $currentInsert = '';
        }
        continue;
    }

    // Start of an INSERT statement
    if (strpos($trimmed, 'INSERT INTO') === 0) {
        $currentInsert = $trimmed;

        // Convert INSERT INTO to INSERT IGNORE INTO
        $currentInsert = preg_replace('/^INSERT INTO/', 'INSERT IGNORE INTO', $currentInsert);

        // If statement ends on this line (ends with ;)
        if (substr($trimmed, -1) === ';') {
            try {
                $pdo->exec($currentInsert);
                $insertCount++;
                if ($insertCount % 100 === 0) {
                    echo "  Processed $insertCount INSERTs...\n";
                }
            } catch (PDOException $e) {
                $errorCount++;
                echo "  ERROR: " . $e->getMessage() . "\n";
                echo "  SQL: " . substr($currentInsert, 0, 100) . "...\n";
            }
            $currentInsert = '';
        }
        continue;
    }

    // Continuation of a multi-line INSERT
    if (!empty($currentInsert)) {
        $currentInsert .= ' ' . $trimmed;

        // Check if the statement is complete
        if (substr($trimmed, -1) === ';') {
            try {
                $pdo->exec($currentInsert);
                $insertCount++;
                if ($insertCount % 100 === 0) {
                    echo "  Processed $insertCount INSERTs...\n";
                }
            } catch (PDOException $e) {
                $errorCount++;
                if ($errorCount <= 10) {
                    echo "  ERROR: " . $e->getMessage() . "\n";
                }
            }
            $currentInsert = '';
        }
    }
}

fclose($handle);

$pdo->exec("SET FOREIGN_KEY_CHECKS=1");

echo "\n=== MERGE COMPLETE ===\n";
echo "Successfully inserted: $insertCount statements\n";
echo "Errors:               $errorCount\n";
echo "\nLocal data was NOT overwritten (INSERT IGNORE used).\n";
echo "New records from live DB have been added to local DB.\n";
