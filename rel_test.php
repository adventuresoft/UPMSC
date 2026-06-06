<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\CouncilMember::first();
echo "Has User: " . method_exists(App\Models\CouncilMember::class, 'user') . "\n";
echo "Has Council: " . method_exists(App\Models\CouncilMember::class, 'council') . "\n";
echo "Has User2: " . method_exists(App\Models\CouncilMember::class, 'User') . "\n";
echo "Has Council2: " . method_exists(App\Models\CouncilMember::class, 'Council') . "\n";
