<?php
$k = intval(trim(fgets(STDIN)));

$pdo = new PDO('sqlite::memory:');
$pdo->exec("CREATE TABLE grades(score INTEGER)");

$stmt = $pdo->prepare("INSERT INTO grades (score) VALUES (?)");
for ($i = 0; $i < $k; $i++) {
    $score = intval(trim(fgets(STDIN)));
    $stmt->execute([$score]);
}

$query = $pdo->query("SELECT score FROM grades");
$scores = $query->fetchAll(PDO::FETCH_ASSOC);

$sum = 0;
foreach ($scores as $row) {
    $sum += $row['score'];
}

$average = $k > 0 ? $sum / $k : 0;
echo number_format($average, 2, '.', '') . PHP_EOL;