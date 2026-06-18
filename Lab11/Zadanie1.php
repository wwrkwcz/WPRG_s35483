<?php
$n = intval(trim(fgets(STDIN)));

$pdo = new PDO('sqlite::memory:');
$pdo->exec("CREATE TABLE numbers(n INTEGER)");

$stmt = $pdo->prepare("INSERT INTO numbers (n) VALUES (?)");
for ($i = 1; $i <= $n; $i++) {
    $stmt->execute([$i]);
}

$query = $pdo->query("SELECT n FROM numbers ORDER BY n");
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo $row['n'] . PHP_EOL;
}