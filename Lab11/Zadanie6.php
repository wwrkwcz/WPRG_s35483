<?php
$k = intval(trim(fgets(STDIN)));
$pdo = new PDO('sqlite::memory:');
$pdo->exec("CREATE TABLE bookings(guest TEXT, room INTEGER, month INTEGER)");

$ins = $pdo->prepare("INSERT INTO bookings VALUES (?, ?, ?)");
for ($i = 0; $i < $k; $i++) {
    $p = explode(';', trim(fgets(STDIN)));
    $ins->execute([$p[0], intval($p[1]), intval($p[2])]);
}

$q = explode(' ', trim(fgets(STDIN)));
$sel = $pdo->prepare("SELECT guest FROM bookings WHERE room = :r AND month = :m ORDER BY guest ASC");
$sel->execute([':r' => intval($q[0]), ':m' => intval($q[1])]);
$res = $sel->fetchAll(PDO::FETCH_ASSOC);

if (empty($res)) {
    echo "EMPTY" . PHP_EOL;
} else {
    foreach ($res as $r) echo $r['guest'] . PHP_EOL;
}