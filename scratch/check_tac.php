<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "agm_voting", 3310);
$result = $mysqli->query("SELECT meeting_tac, tac_expires_at FROM meeting_controls LIMIT 1");
$row = $result->fetch_assoc();
echo "TAC: " . $row['meeting_tac'] . "\n";
echo "Expires At: " . $row['tac_expires_at'] . "\n";
echo "Current Time: " . date('Y-m-d H:i:s') . "\n";
$mysqli->close();
