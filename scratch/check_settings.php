<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$settings = \App\Models\MeetingControl::first();
if ($settings) {
    echo "Meeting Date: " . $settings->meeting_date . "\n";
    echo "Start Time: " . $settings->start_time . "\n";
    echo "End Time: " . $settings->end_time . "\n";
    echo "Meeting TAC: " . $settings->meeting_tac . "\n";
    echo "Current Time: " . now()->toDateTimeString() . "\n";
} else {
    echo "No MeetingControl record found.\n";
}
