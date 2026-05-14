<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "agm_voting", 3310);

$data = [
    ['name' => 'MOHD AZRULL MASNAM', 'staff_id' => '3600511', 'designation' => 'PENGERUSI', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'ABDUL RASHID ZAMRIN', 'staff_id' => '2700280', 'designation' => 'SETIAUSAHA', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'NURULHEZAH MAT LAH', 'staff_id' => '3600606', 'designation' => 'BENDAHARI', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'MUHAMMAD SOFI SUHAIMAI', 'staff_id' => '2700391', 'designation' => 'PEMEGANG AMANAH', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'HASNAH ALIAS', 'staff_id' => '3600743', 'designation' => 'JURUAUDIT', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'MOHD NASIR ZAKARIA', 'staff_id' => '3600163', 'designation' => 'AJK', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'MOHD JEFRI MUSTAKIM', 'staff_id' => '3600568', 'designation' => 'AJK', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'AZIHANAFI MOHD DAKIR', 'staff_id' => '3600894', 'designation' => 'AJK', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'BADRUZZAMAN ABD WAHAB @ WAHAB', 'staff_id' => '3600741', 'designation' => 'AJK', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'HAMDAN ABDUL RAHMAN', 'staff_id' => '1207517', 'designation' => 'AJK', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'MUHAMMAD JAMAL MOHAMAD KAMAL', 'staff_id' => '2700231', 'designation' => 'AJK', 'workplace' => 'FGVGT'],
    ['name' => 'INTAN KHAZILAH MOHMAD LAZI', 'staff_id' => '3600733', 'designation' => 'AJK', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'MOHAMAD AFZAL SALIPON', 'staff_id' => '3600735', 'designation' => 'AJK', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'MOHD FAIRUS ZAINODIN', 'staff_id' => '3600463', 'designation' => 'AJK', 'workplace' => 'FJB - T1, T2, T3'],
    ['name' => 'HERMAN ABDUL HALIM', 'staff_id' => '3600604', 'designation' => 'AJK', 'workplace' => 'FJB - T1, T2, T3'],
];

foreach ($data as $index => $item) {
    // Check if user exists
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE staff_id = ?");
    $stmt->bind_param("s", $item['staff_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $user_id = $row['id'];
    } else {
        $pass = password_hash($item['staff_id'], PASSWORD_DEFAULT);
        $stmt2 = $mysqli->prepare("INSERT INTO users (name, staff_id, workplace, password, role, created_at, updated_at) VALUES (?, ?, ?, ?, 'member', NOW(), NOW())");
        $stmt2->bind_param("ssss", $item['name'], $item['staff_id'], $item['workplace'], $pass);
        $stmt2->execute();
        $user_id = $stmt2->insert_id;
    }

    // Insert into club_officials
    $stmt3 = $mysqli->prepare("INSERT INTO club_officials (user_id, designation, sort_order, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
    $sort = $index + 1;
    $stmt3->bind_param("isi", $user_id, $item['designation'], $sort);
    $stmt3->execute();
}

echo "Successfully seeded officials.\n";
$mysqli->close();
