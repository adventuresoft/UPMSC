<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'upmsc');
if ($conn->connect_error) die("Connection failed");

$tables = ['users', 'districts', 'thanas', 'unions', 'citizen_certificates'];

foreach ($tables as $table) {
    $res = $conn->query("SELECT COUNT(*) as cnt FROM $table");
    if ($res) {
        $row = $res->fetch_assoc();
        echo "Table $table: " . $row['cnt'] . " records\n";
    } else {
        echo "Table $table: Error or missing\n";
    }
}
$conn->close();
