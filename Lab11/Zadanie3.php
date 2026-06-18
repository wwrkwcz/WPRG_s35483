<?php
$k = intval(trim(fgets(STDIN)));

$pdo = new PDO('sqlite::memory:');
$pdo->exec("CREATE TABLE movies(title TEXT, year INTEGER)");

$stmt = $pdo->prepare("INSERT INTO movies (title, year) VALUES (?, ?)");
for ($i = 0; $i < $k; $i++) {
    $line = trim(fgets(STDIN));
    if ($line === '') continue;
    $parts = explode('|', $line);
    $title = $parts[0];
    $year = intval($parts[1]);
    $stmt->execute([$title, $year]);
}

$query = $pdo->query("SELECT title, year FROM movies ORDER BY year ASC, title ASC");
while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    echo "{$row->title} ({$row->year})" . PHP_EOL;
}