<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "agm_voting", 3310);
$expiry = date('Y-m-d H:i:s', strtotime('+12 hours'));
$mysqli->query("UPDATE meeting_controls SET meeting_tac = '696655', tac_expires_at = '$expiry', meeting_date = '2026-05-06'");
echo "Reset TAC to 696655 and extended expiry to $expiry\n";
$mysqli->close();
