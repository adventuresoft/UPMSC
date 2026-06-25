<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$t = \App\Models\Thana::first();
$u = \App\Models\Upazilla::first();
echo 'Thana: ' . $t->getTable() . ' | ID: ' . $t->id . ' | name: ' . $t->bn_name . "\n";
echo 'Upazilla: ' . $u->getTable() . ' | ID: ' . $u->id . ' | name: ' . $u->bn_name . "\n";
