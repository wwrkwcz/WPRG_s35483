<?php
$k = intval(trim(fgets(STDIN)));
$pdo = new PDO('sqlite::memory:');
$pdo->exec("CREATE TABLE jobs(title TEXT, salary INTEGER)");

$ins = $pdo->prepare("INSERT INTO jobs VALUES (?, ?)");
for ($i = 0; $i < $k; $i++) {
    $p = explode('|', trim(fgets(STDIN)));
    $ins->execute([$p[0], intval($p[1])]);
}

$q = explode(' ', trim(fgets(STDIN)));
$upd = $pdo->prepare("UPDATE jobs SET salary = salary + :raise WHERE salary < :th");
$upd->execute([':raise' => intval($q[1]), ':th' => intval($q[0])]);
echo $upd->rowCount() . PHP_EOL;

foreach ($pdo->query("SELECT * FROM jobs ORDER BY title ASC") as $r) {
    echo "{$r['title']}={$r['salary']}" . PHP_EOL;
}