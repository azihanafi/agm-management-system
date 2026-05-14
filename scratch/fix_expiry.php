<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "agm_voting", 3310);
$expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));
$mysqli->query("UPDATE meeting_controls SET tac_expires_at = '$expiry'");
echo "Reset current TAC expiry to 5 minutes from now ($expiry)\n";
$mysqli->close();
