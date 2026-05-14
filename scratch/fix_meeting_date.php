<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "agm_voting", 3310);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$today = date('Y-m-d');
$sql = "UPDATE meeting_controls SET meeting_date = '$today'";
if ($mysqli->query($sql) === TRUE) {
    echo "Successfully updated meeting_date to $today\n";
} else {
    echo "Error updating record: " . $mysqli->error . "\n";
}

$mysqli->close();
