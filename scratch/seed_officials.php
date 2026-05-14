<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\ClubOfficial;
use Illuminate\Support\Facades\Hash;

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
    $user = User::firstOrCreate(
        ['staff_id' => $item['staff_id']],
        [
            'name' => $item['name'],
            'workplace' => $item['workplace'],
            'password' => Hash::make($item['staff_id']),
            'role' => 'member'
        ]
    );

    ClubOfficial::updateOrCreate(
        ['designation' => $item['designation'], 'user_id' => $user->id],
        ['sort_order' => $index + 1]
    );
}

echo "Seeded " . count($data) . " officials.\n";
