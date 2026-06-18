<?php
$k = intval(trim(fgets(STDIN)));
$pdo = new PDO('sqlite::memory:');
$pdo->exec("CREATE TABLE users(login TEXT, password TEXT)");

$ins = $pdo->prepare("INSERT INTO users VALUES (?, ?)");
for ($i = 0; $i < $k; $i++) {
    $line = rtrim(fgets(STDIN), "\r\n");
    $p = explode('|', $line);
    $ins->execute([$p[0], $p[1] ?? '']);
}

$q = intval(trim(fgets(STDIN)));
$sel = $pdo->prepare("SELECT COUNT(*) FROM users WHERE login = ? AND password = ?");
for ($i = 0; $i < $q; $i++) {
    $line = rtrim(fgets(STDIN), "\r\n");
    $p = explode('|', $line);
    
    $sel->execute([$p[0], $p[1] ?? '']);
    echo ($sel->fetchColumn() == 1 ? "OK" : "FAIL") . PHP_EOL;
}