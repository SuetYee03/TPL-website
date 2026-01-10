<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Testing connection...\n";
    \DB::connection()->getPdo();
    echo "Database connection is working successfully.\n";
} catch (\Exception $e) {
    echo "Database Error: " . $e->getMessage() . "\n";
}
