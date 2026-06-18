<?php
$k = intval(trim(fgets(STDIN)));
$pdo = new PDO('sqlite::memory:');
$pdo->exec("CREATE TABLE readings(city TEXT, temp INTEGER, hum INTEGER)");

$stmt = $pdo->prepare("INSERT INTO readings VALUES (?, ?, ?)");
for ($i = 0; $i < $k; $i++) {
    $parts = explode(';', trim(fgets(STDIN)));
    $stmt->execute([$parts[0], intval($parts[1]), intval($parts[2])]);
}

$row = $pdo->query("SELECT city, temp, hum FROM readings ORDER BY temp DESC, rowid ASC")->fetch(PDO::FETCH_NUM);
echo "{$row[0]} {$row[1]} {$row[2]}" . PHP_EOL;