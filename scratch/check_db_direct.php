<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "agm_voting", 3310);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM meeting_controls LIMIT 1");
if ($row = $result->fetch_assoc()) {
    echo "Meeting Date: " . $row['meeting_date'] . "\n";
    echo "Start Time: " . $row['start_time'] . "\n";
    echo "End Time: " . $row['end_time'] . "\n";
    echo "Meeting TAC: " . $row['meeting_tac'] . "\n";
} else {
    echo "No meeting_controls found.\n";
}

$now = new DateTime("now", new DateTimeZone("Asia/Kuala_Lumpur"));
echo "Current Server Time: " . $now->format('Y-m-d H:i:s') . "\n";

$mysqli->close();
