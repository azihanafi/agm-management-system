<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "agm_voting", 3310);
$result = $mysqli->query("SELECT staff_id, name FROM users");
while($row = $result->fetch_assoc()) {
    echo $row['staff_id'] . " | " . $row['name'] . "\n";
}
$mysqli->close();
