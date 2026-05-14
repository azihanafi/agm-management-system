<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "agm_voting", 3310);
$result = $mysqli->query("DESCRIBE attendances");
while($row = $result->fetch_assoc()) {
    echo "Field: " . $row['Field'] . " | Type: " . $row['Type'] . "\n";
}
$mysqli->close();
