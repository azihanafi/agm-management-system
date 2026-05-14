<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\MeetingControl;
use App\Models\Position;
use App\Models\Nomination;

$settings = MeetingControl::first();

// Auto-fix if date is in the past
if ($settings->meeting_date < now()->format('Y-m-d')) {
    echo "Old date detected ({$settings->meeting_date}). Updating to today...\n";
    $settings->update(['meeting_date' => now()->format('Y-m-d')]);
    $settings = MeetingControl::first();
}

echo "--- Meeting Settings ---\n";
echo "Meeting Date: " . ($settings->meeting_date ?? 'NULL') . "\n";
echo "Start Time:   " . ($settings->start_time ?? 'NULL') . "\n";
echo "End Time:     " . ($settings->end_time ?? 'NULL') . "\n";
echo "Current Time: " . now()->toDateTimeString() . "\n";
echo "----------------------\n";

// Check if currently open
$now = now();
$startTime = \Carbon\Carbon::parse($settings->meeting_date . ' ' . $settings->start_time);
$endTime = \Carbon\Carbon::parse($settings->meeting_date . ' ' . $settings->end_time);

if ($now->between($startTime, $endTime)) {
    echo "STATUS: SUCCESS - Session is currently OPEN.\n";
} else {
    echo "STATUS: WARNING - Session is CLOSED (Outside schedule).\n";
    if ($now->lt($startTime)) echo "Reason: Too early (Starts at " . $startTime->format('H:i') . ")\n";
    if ($now->gt($endTime)) echo "Reason: Too late (Ended at " . $endTime->format('H:i') . ")\n";
}

echo "----------------------\n";
echo "Active Position ID: " . ($settings->active_position_id ?? 'NULL') . "\n";
