<?php
$k = intval(trim(fgets(STDIN)));
$pdo = new PDO('sqlite::memory:');
$pdo->exec("CREATE TABLE books(isbn TEXT, title TEXT)");

$ins = $pdo->prepare("INSERT INTO books VALUES (?, ?)");
for ($i = 0; $i < $k; $i++) {
    $ins->execute(explode('|', trim(fgets(STDIN))));
}

$q = intval(trim(fgets(STDIN)));
$sel = $pdo->prepare("SELECT title FROM books WHERE isbn = ?");
for ($i = 0; $i < $q; $i++) {
    $sel->execute([trim(fgets(STDIN))]);
    $row = $sel->fetch(PDO::FETCH_ASSOC);
    echo ($row ? $row['title'] : "NOT FOUND") . PHP_EOL;
}