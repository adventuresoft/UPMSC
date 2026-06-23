<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$permissions = \Spatie\Permission\Models\Permission::pluck('name')->map(function($name) {
    return explode('.', $name)[0];
})->unique()->values()->toArray();

file_put_contents('perms_dump.json', json_encode($permissions, JSON_PRETTY_PRINT));
echo "Done";
